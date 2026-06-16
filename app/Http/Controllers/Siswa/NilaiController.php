<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\KelasMapel;
use App\Models\NilaiAkhir;
use App\Models\Penilaian;
use App\Models\NilaiSumatif;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NilaiController extends Controller
{


    public function index()
    {
        $siswa = Auth::guard('siswa')->user();

        // Ambil hanya kelas yang pernah memiliki nilai akhir siswa ini
        $kelasIds = NilaiAkhir::where('id_siswa', $siswa->id_siswa)
            ->pluck('id_kelas')
            ->unique();

        $kelasList = Kelas::whereIn('id_kelas', $kelasIds)
            ->orderBy('tahun_ajar')
            ->get();

        $nilaiPerKelas = [];

        foreach ($kelasList as $kelas) {

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
                ])->first();

                $babPenilaian = Penilaian::where([
                    'id_kelas' => $kelas->id_kelas,
                    'id_mapel' => $mapel->id_mapel,
                    'jenis_penilaian' => 'sumatif',
                ])
                    ->whereNull('tipe_sumatif')
                    ->orderBy('bab_ke')
                    ->get();

                $detailBab = [];

                foreach ($babPenilaian as $bab) {

                    $nilaiBab = NilaiSumatif::where([
                        'id_penilaian' => $bab->id,
                        'id_siswa' => $siswa->id_siswa,
                    ])->value('nilai_bab');

                    $detailBab[$bab->bab_ke] = $nilaiBab ?? 0;
                }

                $dataMapel[] = [
                    'mapel' => $mapel,
                    'detail_bab' => $detailBab,
                    'rata_bab' => $nilaiAkhir->rata_bab ?? 0,
                    'psts' => $nilaiAkhir->nilai_psts ?? 0,
                    'psas' => $nilaiAkhir->nilai_psas ?? 0,
                    'nilai_akhir' => $nilaiAkhir->nilai_akhir ?? 0,
                ];
            }

            // Nama tab = nama kelas + tahun ajar
            $namaTab = $kelas->nama_kelas . ' (' . $kelas->tahun_ajar . ')';

            $nilaiPerKelas[$namaTab] = $dataMapel;
        }

        $semuaBab = Penilaian::where('jenis_penilaian', 'sumatif')
            ->whereNull('tipe_sumatif')
            ->pluck('bab_ke')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view(
            'siswa.nilai.index',
            compact(
                'siswa',
                'nilaiPerKelas',
                'semuaBab'
            )
        );
    }
    // export removed: exports are handled by Guru only
}
