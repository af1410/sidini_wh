<?php

namespace Database\Seeders;

use App\Models\NilaiFormatif;
use App\Models\SiswaKelas;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NilaiFormatifSeeder extends Seeder
{
    public function run(): void
    {
        $idPenilaian = 42;
        $babKe = 1;
        $siswaKelas = SiswaKelas::where('id_kelas', 'KX2526002')
            ->where('id_tahun_ajar', 3)
            ->where('status', 'aktif')
            ->get();
        $nilaiSiswa = [
            12 => [90, 85, 88],
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
