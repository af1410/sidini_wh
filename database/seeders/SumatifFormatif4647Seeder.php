<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SiswaKelas;
use App\Models\NilaiFormatif;
use Carbon\Carbon;

class SumatifFormatif4647Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Sumatif
        $idPenilaian = 47;
        $siswaKelas = DB::table('siswa_kelas')
            ->where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilai = [
            12 => ['tes' => 86, 'tugas' => 80],
            13 => ['tes' => 80, 'tugas' => 86],
            14 => ['tes' => 88, 'tugas' => 88],
            15 => ['tes' => 90, 'tugas' => 75],
            16 => ['tes' => 86, 'tugas' => 89],
            17 => ['tes' => 86, 'tugas' => 90],
            18 => ['tes' => 86, 'tugas' => 87],
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

        //Formatif
        $idPenilaianF = 46;
        $babKe = 1;
        $siswaKelas = SiswaKelas::where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilaiSiswa = [
            12 => [86, 84, 81],
            13 => [89, 84, 87],
            14 => [88, 86, 90],
            15 => [92, 88, 91],
            16 => [85, 82, 86],
            17 => [87, 85, 89],
            18 => [90, 88, 92],
        ];
        foreach ($siswaKelas as $siswaKelasData) {
            $idSiswa = $siswaKelasData->id_siswa;
            $nilaiPertemuan = $nilaiSiswa[$idSiswa] ?? [
                rand(80, 95),
                rand(80, 95),
                rand(80, 95),
            ];
            $totalNilai = 0;
            for ($pertemuan = 1; $pertemuan <= 3; $pertemuan++) {
                $nilai = $nilaiPertemuan[$pertemuan - 1];
                $totalNilai += $nilai;
                $nilaiBab = round($totalNilai / $pertemuan, 2);
                NilaiFormatif::updateOrCreate(
                    [
                        'id_penilaian' => $idPenilaianF,
                        'id_siswa' => $idSiswa,
                        'bab_ke' => $babKe,
                        'pertemuan_ke' => $pertemuan,
                    ],
                    [
                        'tanggal_input' => Carbon::create(2026, 8, 14)->addDays($pertemuan - 1)->format('Y-m-d'),
                        'nilai_formatif' => $nilai,
                        'nilai_bab' => $nilaiBab,
                        'status_data' => 'aktif',
                    ]
                );
            }
        }
    }
}
