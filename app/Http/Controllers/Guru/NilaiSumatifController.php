<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiSumatif;
use App\Models\NilaiSumatifTugas;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\NilaiSumatifExport;
use Maatwebsite\Excel\Facades\Excel;

class NilaiSumatifController extends Controller
{
    public function show($id_kelas, $id_mapel)
    {
        $guru = Auth::guard('guru')->user();

        if (!$guru) {
            abort(403);
        }

        $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        $penilaians = Penilaian::with([
            'kelas.siswas',
            'mapel',
            'nilaiSumatif.tugas'
        ])
            ->where('id_kelas', $id_kelas)
            ->where('id_mapel', $id_mapel)
            ->where('id_guru', $guru->id_guru)
            ->where('jenis_penilaian', 'sumatif')
            ->whereNull('tipe_sumatif')
            ->where('semester', $semester)
            ->orderBy('bab_ke')
            ->get();

        if ($penilaians->isEmpty()) {
            return back()->with(
                'error',
                'Penilaian sumatif belum tersedia.'
            );
        }

        $siswa = $penilaians->first()->kelas->siswas;

        $babList = $penilaians
            ->pluck('bab_ke')
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        $babAktif = !empty($babList)
            ? max($babList)
            : 1;

        $tugasPerBab = [];
        $nilaiPivot = [];

        foreach ($penilaians as $penilaian) {

            $bab = $penilaian->bab_ke;

            foreach ($penilaian->nilaiSumatif as $nilai) {

                $nilaiPivot[$bab][$nilai->id_siswa] = [
                    'tes_tulis' => $nilai->nilai_tes_tulis,
                    'kehadiran' => $nilai->nilai_kehadiran,
                    'nilai_bab' => $nilai->nilai_bab,
                    'tugas' => []
                ];

                foreach ($nilai->tugas as $tugas) {

                    $tugasPerBab[$bab][] =
                        $tugas->urutan_tugas;

                    $nilaiPivot[$bab][$nilai->id_siswa]['tugas'][$tugas->urutan_tugas]
                        = $tugas->nilai;
                }
            }
        }

        foreach ($babList as $bab) {

            if (!isset($tugasPerBab[$bab])) {
                $tugasPerBab[$bab] = [1];
            }

            $tugasPerBab[$bab] = collect(
                $tugasPerBab[$bab]
            )
                ->unique()
                ->sort()
                ->values()
                ->toArray();
        }

        return view(
            'guru.nilai_sumatif.show',
            compact(
                'penilaians',
                'siswa',
                'babList',
                'babAktif',
                'tugasPerBab',
                'nilaiPivot'
            )
        );
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $guru = Auth::guard('guru')->user();

            $bobotTugas = $request->bobot_tugas ?? 40;
            $bobotTesTulis = $request->bobot_tes_tulis ?? 50;
            $bobotKehadiran = $request->bobot_kehadiran ?? 10;

            /*
        |--------------------------------------------------------------------------
        | BAB YANG SUDAH ADA
        |--------------------------------------------------------------------------
        */

            $tesTulis = $request->tes_tulis ?? [];
            $kehadiran = $request->kehadiran ?? [];
            $tugas = $request->tugas ?? [];

            foreach ($tesTulis as $idPenilaian => $siswaList) {

                foreach ($siswaList as $idSiswa => $nilaiTes) {

                    $nilaiHadir =
                        $kehadiran[$idPenilaian][$idSiswa] ?? 0;

                    $nilaiTugas = collect(
                        $tugas[$idPenilaian][$idSiswa] ?? []
                    )->filter(
                        fn($n) => $n !== '' && $n !== null
                    );

                    $rataTugas =
                        $nilaiTugas->count()
                        ? round($nilaiTugas->avg(), 2)
                        : 0;

                    $nilaiBab =
                        ($rataTugas * $bobotTugas / 100)
                        + ($nilaiTes * $bobotTesTulis / 100)
                        + ($nilaiHadir * $bobotKehadiran / 100);

                    $sumatif = NilaiSumatif::updateOrCreate(
                        [
                            'id_penilaian' => $idPenilaian,
                            'id_siswa' => $idSiswa,
                        ],
                        [
                            'nilai_tes_tulis' => $nilaiTes,
                            'nilai_kehadiran' => $nilaiHadir,

                            'bobot_tugas' => $bobotTugas,
                            'bobot_tes_tulis' => $bobotTesTulis,
                            'bobot_kehadiran' => $bobotKehadiran,

                            'nilai_bab' => round($nilaiBab, 2),
                            'status_data' => 'submitted',
                        ]
                    );

                    $sumatif->tugas()->delete();

                    foreach (
                        ($tugas[$idPenilaian][$idSiswa] ?? [])
                        as $urutanTugas => $nilaiTugasItem
                    ) {

                        if ($nilaiTugasItem === '' || $nilaiTugasItem === null) {
                            continue;
                        }

                        NilaiSumatifTugas::create([
                            'id_sumatif' => $sumatif->id,
                            'nama_tugas' => 'Tugas ' . $urutanTugas,
                            'urutan_tugas' => $urutanTugas,
                            'nilai' => $nilaiTugasItem,
                        ]);
                    }
                }
            }

            /*
        |--------------------------------------------------------------------------
        | BAB BARU DARI JAVASCRIPT
        |--------------------------------------------------------------------------
        */

            $babBaru = $request->bab_baru ?? [];

            if (!empty($babBaru)) {

                $penilaianAwal = Penilaian::find(
                    array_key_first($tesTulis)
                );

                foreach ($babBaru as $babKe => $siswaList) {

                    $penilaianBaru = Penilaian::create([
                        'id_guru' => $guru->id_guru,
                        'id_mapel' => $penilaianAwal->id_mapel,
                        'id_kelas' => $penilaianAwal->id_kelas,
                        'semester' => $penilaianAwal->semester,

                        'jenis_penilaian' => 'sumatif',

                        'bab_ke' => $babKe,
                        'judul_bab' => 'Bab ' . $babKe,

                        'tanggal_mulai' => now(),
                        'tanggal_selesai' => now()->addMonth(),

                        'status_buka' => 'dibuka',
                        'status_approval' => 'normal',
                        'dibuka_oleh' => $guru->id_guru,
                    ]);

                    foreach ($siswaList as $idSiswa => $nilaiData) {

                        $nilaiTes =
                            $nilaiData['tes'] ?? 0;

                        $nilaiHadir =
                            $nilaiData['hadir'] ?? 0;

                        $nilaiTugas = collect(
                            $nilaiData['tugas'] ?? []
                        )->filter(
                            fn($n) => $n !== '' && $n !== null
                        );

                        $rataTugas =
                            $nilaiTugas->count()
                            ? round($nilaiTugas->avg(), 2)
                            : 0;

                        $nilaiBab =
                            ($rataTugas * $bobotTugas / 100)
                            + ($nilaiTes * $bobotTesTulis / 100)
                            + ($nilaiHadir * $bobotKehadiran / 100);

                        $sumatif = NilaiSumatif::create([
                            'id_penilaian' => $penilaianBaru->id,
                            'id_siswa' => $idSiswa,

                            'nilai_tes_tulis' => $nilaiTes,
                            'nilai_kehadiran' => $nilaiHadir,

                            'bobot_tugas' => $bobotTugas,
                            'bobot_tes_tulis' => $bobotTesTulis,
                            'bobot_kehadiran' => $bobotKehadiran,

                            'nilai_bab' => round($nilaiBab, 2),

                            'status_data' => 'submitted',
                        ]);

                        foreach (
                            ($nilaiData['tugas'] ?? [])
                            as $urutanTugas => $nilaiTugasItem
                        ) {

                            if ($nilaiTugasItem === '' || $nilaiTugasItem === null) {
                                continue;
                            }

                            NilaiSumatifTugas::create([
                                'id_sumatif' => $sumatif->id,
                                'nama_tugas' => 'Tugas ' . $urutanTugas,
                                'urutan_tugas' => $urutanTugas,
                                'nilai' => $nilaiTugasItem,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return back()->with(
                'success',
                'Nilai sumatif berhasil disimpan.'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal menyimpan nilai sumatif : ' . $e->getMessage()
            );
        }
    }

    public function store1(Request $request)
    {
        DB::beginTransaction();

        try {

            $tesTulis  = $request->tes_tulis ?? [];
            $kehadiran = $request->kehadiran ?? [];
            $tugas     = $request->tugas ?? [];

            $bobotTugas = $request->bobot_tugas ?? 40;
            $bobotTesTulis = $request->bobot_tes_tulis ?? 50;
            $bobotKehadiran = $request->bobot_kehadiran ?? 10;

            foreach ($tesTulis as $idPenilaian => $siswaList) {

                foreach ($siswaList as $idSiswa => $nilaiTes) {

                    $nilaiHadir =
                        $kehadiran[$idPenilaian][$idSiswa] ?? 0;

                    $nilaiTugas = collect(
                        $tugas[$idPenilaian][$idSiswa] ?? []
                    )->filter(
                        fn($nilai) =>
                        $nilai !== '' &&
                            $nilai !== null
                    );

                    $rataTugas = $nilaiTugas->count()
                        ? round($nilaiTugas->avg(), 2)
                        : 0;

                    $nilaiBab =
                        ($rataTugas * $bobotTugas / 100)
                        + ($nilaiTes * $bobotTesTulis / 100)
                        + ($nilaiHadir * $bobotKehadiran / 100);

                    $sumatif = NilaiSumatif::updateOrCreate(
                        [
                            'id_penilaian' => $idPenilaian,
                            'id_siswa' => $idSiswa,
                        ],
                        [
                            'nilai_tes_tulis' => $nilaiTes,
                            'nilai_kehadiran' => $nilaiHadir,

                            'bobot_tugas' => $bobotTugas,
                            'bobot_tes_tulis' => $bobotTesTulis,
                            'bobot_kehadiran' => $bobotKehadiran,

                            'nilai_bab' => round($nilaiBab, 2),

                            'status_data' => 'submitted',
                        ]
                    );

                    $sumatif->tugas()->delete();

                    foreach (
                        ($tugas[$idPenilaian][$idSiswa] ?? [])
                        as $urutanTugas => $nilaiTugas
                    ) {

                        if (
                            $nilaiTugas === '' ||
                            $nilaiTugas === null
                        ) {
                            continue;
                        }

                        NilaiSumatifTugas::create([
                            'id_sumatif' => $sumatif->id,
                            'nama_tugas' => 'Tugas ' . $urutanTugas,
                            'urutan_tugas' => $urutanTugas,
                            'nilai' => $nilaiTugas,
                        ]);
                    }
                }
            }

            DB::commit();

            return back()->with(
                'success',
                'Nilai sumatif berhasil disimpan.'
            );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal menyimpan nilai sumatif : ' . $e->getMessage()
            );
        }
    }

    public function export($id_kelas, $id_mapel)
    {
        $guru = Auth::guard('guru')->user();

        $semester = now()->month >= 7 ? 'ganjil' : 'genap';

        $penilaians = Penilaian::with([
            'kelas.siswas',
            'nilaiSumatif.tugas'
        ])
            ->where('id_kelas', $id_kelas)
            ->where('id_mapel', $id_mapel)
            ->where('jenis_penilaian', 'sumatif')
            ->where('semester', $semester)
            ->orderBy('bab_ke')
            ->get();

        $siswa = $penilaians->first()->kelas->siswas;

        $babList = [];
        $tugasPerBab = [];
        $rows = [];

        foreach ($penilaians as $penilaian) {

            $babList[] = $penilaian->bab_ke;

            foreach ($penilaian->nilaiSumatif as $nilai) {

                foreach ($nilai->tugas as $tugas) {

                    $tugasPerBab[$penilaian->bab_ke][] =
                        $tugas->urutan_tugas;
                }
            }
        }

        foreach ($babList as $bab) {

            $tugasPerBab[$bab] =
                collect($tugasPerBab[$bab] ?? [1])
                ->unique()
                ->sort()
                ->values()
                ->toArray();
        }

        foreach ($siswa as $index => $item) {

            $row = [
                $index + 1,
                $item->nama_siswa
            ];

            foreach ($penilaians as $penilaian) {

                $nilai = $penilaian->nilaiSumatif
                    ->where('id_siswa', $item->id_siswa)
                    ->first();

                foreach ($tugasPerBab[$penilaian->bab_ke] as $urutan) {

                    $nilaiTugas = optional(
                        optional($nilai)->tugas
                    )->where(
                        'urutan_tugas',
                        $urutan
                    )->first();

                    $row[] = $nilaiTugas->nilai ?? '';
                }

                $row[] = $nilai->nilai_tes_tulis ?? '';
                $row[] = $nilai->nilai_kehadiran ?? '';
                $row[] = $nilai->nilai_bab ?? '';
            }

            $rows[] = $row;
        }

        return Excel::download(
            new NilaiSumatifExport(
                $rows,
                $babList,
                $tugasPerBab
            ),
            'nilai-sumatif.xlsx'
        );
    }
}
