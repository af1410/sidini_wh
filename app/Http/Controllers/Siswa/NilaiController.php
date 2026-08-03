<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KelasMapel;
use App\Models\SiswaKelas;
use App\Models\NilaiAkhir;
use App\Models\Penilaian;
use App\Models\NilaiSumatif;
use App\Models\SumatifUjian;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $semester = $request->semester ?? (now()->month < 7 ? 'genap' : 'ganjil');

        $siswa = Auth::guard('siswa')->user();

        $riwayatKelas = SiswaKelas::with([
            'kelas',
            'tahunAjar'
        ])
            ->where('id_siswa', $siswa->id_siswa)
            ->orderByDesc('created_at')
            ->get();

        $nilaiPerKelas = [];

        foreach ($riwayatKelas as $riwayat) {

            $kelas = $riwayat->kelas;

            if (!$kelas) {
                continue;
            }

            $mapels = KelasMapel::with('mapel')
                ->where('id_kelas', $kelas->id_kelas)
                ->get();

            $dataMapel = [];

            foreach ($mapels as $km) {

                $mapel = $km->mapel;

                $nilaiAkhir = NilaiAkhir::where([
                    'id_siswa' => $siswa->id_siswa,
                    'id_kelas' => $kelas->id_kelas,
                    'id_mapel' => $mapel->id_mapel,
                    'semester' => $semester,
                ])->first();

                $babPenilaian = Penilaian::where([
                    'id_kelas'        => $kelas->id_kelas,
                    'id_mapel'        => $mapel->id_mapel,
                    'id_tahun_ajar'   => $riwayat->id_tahun_ajar,
                    'semester'        => $semester,
                    'jenis_penilaian' => 'sumatif',
                ])
                    ->whereNull('tipe_sumatif')
                    ->orderBy('bab_ke')
                    ->get();



                $psts = SumatifUjian::where('id_penilaian', function ($q) use ($kelas, $mapel, $riwayat, $semester) {
                    $q->select('id')
                        ->from('penilaian')
                        ->where('id_kelas', $kelas->id_kelas)
                        ->where('id_mapel', $mapel->id_mapel)
                        ->where('id_tahun_ajar', $riwayat->id_tahun_ajar)
                        ->where('semester', $semester)
                        ->where('jenis_penilaian', 'sumatif')
                        ->where('tipe_sumatif', 'PSTS')
                        ->limit(1);
                })
                    ->where('id_siswa', $siswa->id_siswa)
                    ->value('nilai_ujian');

                $psas = SumatifUjian::where('id_penilaian', function ($q) use ($kelas, $mapel, $riwayat, $semester) {
                    $q->select('id')
                        ->from('penilaian')
                        ->where('id_kelas', $kelas->id_kelas)
                        ->where('id_mapel', $mapel->id_mapel)
                        ->where('id_tahun_ajar', $riwayat->id_tahun_ajar)
                        ->where('semester', $semester)
                        ->where('jenis_penilaian', 'sumatif')
                        ->where('tipe_sumatif', 'PSAS')
                        ->limit(1);
                })
                    ->where('id_siswa', $siswa->id_siswa)
                    ->value('nilai_ujian');


                $detailBab = [];

                foreach ($babPenilaian as $bab) {

                    $detailBab[$bab->bab_ke] = NilaiSumatif::where([
                        'id_penilaian' => $bab->id,
                        'id_siswa'     => $siswa->id_siswa,
                    ])->value('nilai_bab');
                }

                $nilaiBab = array_filter($detailBab, function ($nilai) {
                    return $nilai !== null;
                });

                $rataBab = count($nilaiBab)
                    ? round(array_sum($nilaiBab) / count($nilaiBab), 2)
                    : 0;

                $dataMapel[] = [
                    'mapel'       => $mapel,
                    'detail_bab'  => $detailBab,
                    'rata_bab'    =>  $nilaiAkhir?->rata_bab ?: $rataBab,
                    'psts'        => $psts,
                    'psas'        => $psas,
                    'nilai_akhir' => $nilaiAkhir?->nilai_akhir,
                ];
            }

            $namaTab = $kelas->nama_kelas .
                ' (' .
                optional($riwayat->tahunAjar)->tahun_mulai .
                '/' .
                optional($riwayat->tahunAjar)->tahun_selesai .
                ')';

            $nilaiPerKelas[$namaTab] = $dataMapel;
        }

        $semuaBab = Penilaian::where([
            'jenis_penilaian' => 'sumatif',
            'semester' => $semester,
        ])
            ->whereNull('tipe_sumatif')
            ->pluck('bab_ke')
            ->unique()
            ->sort()
            ->values();

        return view(
            'siswa.nilai.index',
            compact(
                'siswa',
                'nilaiPerKelas',
                'semuaBab',
                'semester'
            )
        );
    }
}
