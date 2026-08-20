<?php

namespace Database\Seeders;

use App\Models\NilaiFormatif;
use App\Models\SiswaKelas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NilaiFormatifAllSeeder extends Seeder
{
    public function run(): void
    {
        $idPenilaians = [50, 54, 58, 62, 66, 70, 74, 78, 82, 86, 90, 94];
        $babKe = 1;
        $siswaKelas = SiswaKelas::where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilaiSiswa = [
            50 => [
                12 => [90, 84, 88],
                13 => [85, 89, 87],
                14 => [92, 86, 90],
                15 => [78, 83, 81],
                16 => [88, 91, 86],
                17 => [94, 89, 92],
                18 => [82, 87, 85],
            ],
            54 => [
                12 => [86, 91, 89],
                13 => [93, 88, 90],
                14 => [80, 85, 83],
                15 => [88, 84, 86],
                16 => [91, 87, 94],
                17 => [85, 90, 88],
                18 => [89, 82, 87],
            ],
            58 => [
                12 => [83, 88, 85],
                13 => [90, 92, 89],
                14 => [87, 81, 84],
                15 => [94, 89, 91],
                16 => [79, 85, 82],
                17 => [88, 93, 90],
                18 => [92, 86, 88],
            ],
            62 => [
                12 => [91, 87, 93],
                13 => [84, 89, 86],
                14 => [89, 85, 90],
                15 => [82, 80, 84],
                16 => [95, 91, 93],
                17 => [87, 90, 88],
                18 => [80, 86, 83],
            ],
            66 => [
                12 => [88, 85, 91],
                13 => [81, 87, 84],
                14 => [93, 90, 92],
                15 => [86, 82, 88],
                16 => [90, 94, 91],
                17 => [84, 89, 87],
                18 => [92, 88, 90],
            ],
            70 => [
                12 => [79, 84, 82],
                13 => [89, 86, 91],
                14 => [85, 90, 88],
                15 => [92, 87, 94],
                16 => [83, 81, 86],
                17 => [90, 93, 89],
                18 => [87, 85, 92],
            ],
            74 => [
                12 => [94, 89, 91],
                13 => [86, 82, 88],
                14 => [80, 84, 81],
                15 => [91, 93, 90],
                16 => [87, 89, 85],
                17 => [83, 88, 86],
                18 => [90, 85, 92],
            ],
            78 => [
                12 => [85, 90, 87],
                13 => [92, 88, 94],
                14 => [84, 79, 82],
                15 => [89, 91, 87],
                16 => [93, 86, 90],
                17 => [81, 85, 83],
                18 => [88, 92, 89],
            ],
            82 => [
                12 => [90, 93, 91],
                13 => [83, 87, 85],
                14 => [88, 91, 89],
                15 => [95, 90, 92],
                16 => [86, 84, 88],
                17 => [91, 87, 94],
                18 => [82, 89, 86],
            ],
            86 => [
                12 => [87, 82, 89],
                13 => [91, 94, 92],
                14 => [85, 88, 84],
                15 => [80, 86, 83],
                16 => [92, 89, 95],
                17 => [88, 91, 90],
                18 => [84, 87, 86],
            ],
            90 => [
                12 => [93, 88, 90],
                13 => [85, 90, 87],
                14 => [91, 94, 92],
                15 => [84, 81, 86],
                16 => [89, 93, 91],
                17 => [96, 90, 94],
                18 => [87, 85, 89],
            ],
            94 => [
                12 => [82, 88, 85],
                13 => [89, 84, 91],
                14 => [94, 91, 93],
                15 => [87, 90, 88],
                16 => [91, 86, 94],
                17 => [85, 92, 89],
                18 => [90, 83, 87],
            ],
        ];
        foreach ($idPenilaians as $idPenilaian) {
            foreach ($siswaKelas as $siswaKelasData) {
                $idSiswa = $siswaKelasData->id_siswa;
                $nilaiPertemuan = $nilaiSiswa[$idPenilaian][$idSiswa] ?? [
                    rand(75, 95),
                    rand(75, 95),
                    rand(75, 95),
                ];
                $totalNilai = 0;
                for ($pertemuan = 1; $pertemuan <= 3; $pertemuan++) {
                    $nilai = $nilaiPertemuan[$pertemuan - 1];
                    $totalNilai += $nilai;
                    $nilaiBab = round($totalNilai / $pertemuan, 2);
                    NilaiFormatif::updateOrCreate(
                        [
                            'id_penilaian' => $idPenilaian,
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
}
