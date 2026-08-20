<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NilaiSumatifAllSeeder extends Seeder
{
    public function run(): void
    {
        $idPenilaians = [51, 55, 59, 63, 67, 71, 75, 79, 83, 87, 91, 95];
        $siswaKelas = DB::table('siswa_kelas')
            ->where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilai = [
            51 => [
                12 => ['tes' => 88, 'tugas' => 80],
                13 => ['tes' => 84, 'tugas' => 86],
                14 => ['tes' => 78, 'tugas' => 88],
                15 => ['tes' => 91, 'tugas' => 75],
                16 => ['tes' => 89, 'tugas' => 89],
                17 => ['tes' => 93, 'tugas' => 90],
                18 => ['tes' => 86, 'tugas' => 92],
            ],
            55 => [
                12 => ['tes' => 82, 'tugas' => 87],
                13 => ['tes' => 91, 'tugas' => 83],
                14 => ['tes' => 85, 'tugas' => 90],
                15 => ['tes' => 88, 'tugas' => 79],
                16 => ['tes' => 94, 'tugas' => 86],
                17 => ['tes' => 87, 'tugas' => 93],
                18 => ['tes' => 90, 'tugas' => 88],
            ],
            59 => [
                12 => ['tes' => 90, 'tugas' => 84],
                13 => ['tes' => 86, 'tugas' => 91],
                14 => ['tes' => 80, 'tugas' => 85],
                15 => ['tes' => 92, 'tugas' => 81],
                16 => ['tes' => 88, 'tugas' => 94],
                17 => ['tes' => 95, 'tugas' => 89],
                18 => ['tes' => 83, 'tugas' => 92],
            ],
            63 => [
                12 => ['tes' => 85, 'tugas' => 89],
                13 => ['tes' => 89, 'tugas' => 86],
                14 => ['tes' => 92, 'tugas' => 83],
                15 => ['tes' => 81, 'tugas' => 90],
                16 => ['tes' => 93, 'tugas' => 88],
                17 => ['tes' => 87, 'tugas' => 91],
                18 => ['tes' => 90, 'tugas' => 85],
            ],
            67 => [
                12 => ['tes' => 87, 'tugas' => 92],
                13 => ['tes' => 83, 'tugas' => 88],
                14 => ['tes' => 91, 'tugas' => 86],
                15 => ['tes' => 89, 'tugas' => 80],
                16 => ['tes' => 95, 'tugas' => 90],
                17 => ['tes' => 84, 'tugas' => 93],
                18 => ['tes' => 88, 'tugas' => 87],
            ],
            71 => [
                12 => ['tes' => 92, 'tugas' => 85],
                13 => ['tes' => 88, 'tugas' => 90],
                14 => ['tes' => 79, 'tugas' => 84],
                15 => ['tes' => 94, 'tugas' => 88],
                16 => ['tes' => 86, 'tugas' => 91],
                17 => ['tes' => 90, 'tugas' => 95],
                18 => ['tes' => 83, 'tugas' => 89],
            ],
            75 => [
                12 => ['tes' => 84, 'tugas' => 91],
                13 => ['tes' => 93, 'tugas' => 85],
                14 => ['tes' => 88, 'tugas' => 92],
                15 => ['tes' => 82, 'tugas' => 78],
                16 => ['tes' => 91, 'tugas' => 87],
                17 => ['tes' => 89, 'tugas' => 94],
                18 => ['tes' => 95, 'tugas' => 86],
            ],
            79 => [
                12 => ['tes' => 89, 'tugas' => 83],
                13 => ['tes' => 85, 'tugas' => 92],
                14 => ['tes' => 93, 'tugas' => 88],
                15 => ['tes' => 86, 'tugas' => 81],
                16 => ['tes' => 90, 'tugas' => 95],
                17 => ['tes' => 96, 'tugas' => 89],
                18 => ['tes' => 87, 'tugas' => 91],
            ],
            83 => [
                12 => ['tes' => 91, 'tugas' => 88],
                13 => ['tes' => 87, 'tugas' => 84],
                14 => ['tes' => 82, 'tugas' => 90],
                15 => ['tes' => 95, 'tugas' => 86],
                16 => ['tes' => 89, 'tugas' => 93],
                17 => ['tes' => 92, 'tugas' => 91],
                18 => ['tes' => 85, 'tugas' => 87],
            ],
            87 => [
                12 => ['tes' => 86, 'tugas' => 90],
                13 => ['tes' => 92, 'tugas' => 87],
                14 => ['tes' => 89, 'tugas' => 84],
                15 => ['tes' => 83, 'tugas' => 91],
                16 => ['tes' => 94, 'tugas' => 88],
                17 => ['tes' => 88, 'tugas' => 95],
                18 => ['tes' => 90, 'tugas' => 86],
            ],
            91 => [
                12 => ['tes' => 93, 'tugas' => 85],
                13 => ['tes' => 81, 'tugas' => 89],
                14 => ['tes' => 87, 'tugas' => 93],
                15 => ['tes' => 90, 'tugas' => 82],
                16 => ['tes' => 92, 'tugas' => 90],
                17 => ['tes' => 85, 'tugas' => 94],
                18 => ['tes' => 89, 'tugas' => 88],
            ],
            95 => [
                12 => ['tes' => 88, 'tugas' => 94],
                13 => ['tes' => 90, 'tugas' => 86],
                14 => ['tes' => 84, 'tugas' => 91],
                15 => ['tes' => 93, 'tugas' => 80],
                16 => ['tes' => 87, 'tugas' => 95],
                17 => ['tes' => 91, 'tugas' => 89],
                18 => ['tes' => 85, 'tugas' => 92],
            ],
        ];
        foreach ($idPenilaians as $idPenilaian) {
            foreach ($siswaKelas as $siswa) {
                $idSiswa = $siswa->id_siswa;
                $dataNilai = $nilai[$idPenilaian][$idSiswa] ?? [
                    'tes' => rand(80, 95),
                    'tugas' => rand(80, 95),
                ];
                $nilaiTes = $dataNilai['tes'];
                $nilaiTugas = $dataNilai['tugas'];
                $bobotTes = 40;
                $bobotTugas = 60;
                $bobotKehadiran = 0;
                $nilaiKehadiran = 0;
                $nilaiBab = round(
                    ($nilaiTes * $bobotTes / 100) +
                        ($nilaiTugas * $bobotTugas / 100) +
                        ($nilaiKehadiran * $bobotKehadiran / 100),
                    2
                );
                $existing = DB::table('nilai_sumatif')
                    ->where('id_penilaian', $idPenilaian)
                    ->where('id_siswa', $idSiswa)
                    ->first();
                if ($existing) {
                    $idSumatif = $existing->id;
                    DB::table('nilai_sumatif')
                        ->where('id', $idSumatif)
                        ->update([
                            'nilai_tes_tulis' => $nilaiTes,
                            'nilai_kehadiran' => $nilaiKehadiran,
                            'bobot_tes_tulis' => $bobotTes,
                            'bobot_tugas' => $bobotTugas,
                            'bobot_kehadiran' => $bobotKehadiran,
                            'nilai_bab' => $nilaiBab,
                            'status_data' => 'submitted',
                            'updated_at' => Carbon::now(),
                        ]);
                } else {
                    $idSumatif = DB::table('nilai_sumatif')->insertGetId([
                        'id_penilaian' => $idPenilaian,
                        'id_siswa' => $idSiswa,
                        'nilai_tes_tulis' => $nilaiTes,
                        'nilai_kehadiran' => $nilaiKehadiran,
                        'bobot_tes_tulis' => $bobotTes,
                        'bobot_tugas' => $bobotTugas,
                        'bobot_kehadiran' => $bobotKehadiran,
                        'nilai_bab' => $nilaiBab,
                        'status_data' => 'submitted',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                DB::table('nilai_sumatif_tugas')->updateOrInsert(
                    [
                        'id_sumatif' => $idSumatif,
                        'urutan_tugas' => 1,
                    ],
                    [
                        'nama_tugas' => 'Tugas 1',
                        'nilai' => $nilaiTugas,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
            }
        }
    }
}
