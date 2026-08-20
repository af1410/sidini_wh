<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\NilaiAkhir;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\KelasMapel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PerlengkapanRapor;
use Illuminate\Support\Facades\Auth;

class RaporSayaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = Siswa::with([
            'dataKelas.waliKelas',
            'dataKelas.tahunAjar',
        ])->findOrFail(Auth::guard('siswa')->id());
        $kelas = $siswa->dataKelas;
        if (!$kelas) {
            abort(404, 'Siswa belum memiliki kelas.');
        }
        $waliKelas = $kelas->waliKelas;
        $semester = strtolower($request->get('semester', 'ganjil'));
        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get()
            ->pluck('mapel')
            ->filter();
        $nilaiAkhir = NilaiAkhir::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_siswa', $siswa->id_siswa)
            ->where('semester', $semester)
            ->get()
            ->keyBy('id_mapel');
        $mapelWithScores = $mapels->map(function ($mapel) use ($nilaiAkhir) {
            $nilai = $nilaiAkhir->get($mapel->id_mapel);
            return (object) [
                'id_mapel' => $mapel->id_mapel,
                'nama_mapel' => $mapel->nama_mapel,
                'jenis_mapel' => $mapel->jenis_mapel,
                'nilai_akhir' => $nilai ? round($nilai->nilai_akhir) : 0,
                'deskripsi' => $nilai->keterangan ?? '-',
            ];
        });
        $mapelUmum = $mapelWithScores
            ->filter(fn($m) => trim(strtolower($m->jenis_mapel)) === 'umum')
            ->values();
        $mapelPilihan = $mapelWithScores
            ->filter(fn($m) => trim(strtolower($m->jenis_mapel)) === 'minat')
            ->values();
        $mapelVokasi = $mapelWithScores
            ->filter(fn($m) => !in_array(
                trim(strtolower($m->jenis_mapel)),
                ['wajib', 'minat']
            ))
            ->values();
        $totalNilai = $mapelWithScores->sum('nilai_akhir');
        $perlengkapanRapor = PerlengkapanRapor::where('id_siswa', $siswa->id_siswa)
            ->first();
        $sakit = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Sakit')
            ->count();
        $izin = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Izin')
            ->count();
        $alpa = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Alpha')
            ->count();
        $pdf = Pdf::loadView('siswa.raporsaya.index', compact(
            'siswa',
            'kelas',
            'waliKelas',
            'semester',
            'mapelUmum',
            'mapelPilihan',
            'mapelVokasi',
            'totalNilai',
            'perlengkapanRapor',
            'sakit',
            'izin',
            'alpa'
        ));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rapor ' . $siswa->nama_siswa . '.pdf');
    }
}
