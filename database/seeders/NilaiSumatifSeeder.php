<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NilaiSumatifSeeder extends Seeder
{
    public function run(): void
    {
        $idPenilaian = 43;
        $siswaKelas = DB::table('siswa_kelas')
            ->where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilai = [
            12 => ['tes' => 88, 'tugas' => 80],
            13 => ['tes' => 88, 'tugas' => 86],
            14 => ['tes' => 78, 'tugas' => 88],
            15 => ['tes' => 89, 'tugas' => 75],
            16 => ['tes' => 89, 'tugas' => 89],
            17 => ['tes' => 90, 'tugas' => 90],
            18 => ['tes' => 90, 'tugas' => 90],
        ];
        foreach ($siswaKelas as $siswa) {
            $idSiswa = $siswa->id_siswa;
            $dataNilai = $nilai[$idSiswa] ?? [
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
