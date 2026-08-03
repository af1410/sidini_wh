<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\NilaiAkhir;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\KelasMapel;
use Illuminate\Support\Facades\Auth;

class RaporSayaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with([
            'dataKelas.waliKelas'
        ])->findOrFail(Auth::guard('siswa')->id());

        $kelas = $siswa->dataKelas;

        if (!$kelas) {
            abort(404, 'Siswa belum memiliki kelas.');
        }

        $mapels = KelasMapel::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->get()
            ->pluck('mapel');

        $nilaiAkhir = NilaiAkhir::with('mapel')
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_siswa', $siswa->id_siswa)
            ->get()
            ->keyBy('id_mapel');

        $mapelWithScores = $mapels->map(function ($mapel) use ($nilaiAkhir) {

            $nilai = $nilaiAkhir->get($mapel->id_mapel);

            return (object) [
                'id_mapel'    => $mapel->id_mapel,
                'nama_mapel'  => $mapel->nama_mapel,
                'jenis_mapel' => $mapel->jenis_mapel,
                'nilai_akhir' => $nilai->nilai_akhir ?? 0,
                'deskripsi'   => $nilai->keterangan ?? '-',
            ];
        });

        $mapelUmum = $mapelWithScores
            ->filter(fn($m) => trim(strtolower($m->jenis_mapel)) === 'wajib')
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

        $semester = $nilaiAkhir->first()?->semester ?? 'Ganjil';

        $sakit = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Sakit')
            ->count();

        $izin = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Izin')
            ->count();

        $alpa = Presensi::where('id_siswa', $siswa->id_siswa)
            ->where('status', 'Alpha')
            ->count();

        return view('siswa.raporsaya.index', compact(
            'siswa',
            'kelas',
            'semester',
            'mapelUmum',
            'mapelPilihan',
            'mapelVokasi',
            'totalNilai',
            'sakit',
            'izin',
            'alpa'
        ))->with([
            'kokurikuler' => '-',
            'ekstrakurikuler' => collect(),
            'prestasi' => collect(),
            'catatan_wali' => '-',
            'kepalaMadrasah' => '-',
        ]);
    }
}
