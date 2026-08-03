<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjar;

class TahunAjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahunAjars = [
            [
                'tahun_ajar' => '2023/2024',
                'tahun_mulai' => 2023,
                'tahun_selesai' => 2024,
                'status' => 'nonaktif',
                'tanggal_mulai' => '2023-07-01',
                'tanggal_selesai' => '2024-06-30',
                'keterangan' => 'Tahun ajaran 2023/2024',
            ],
            [
                'tahun_ajar' => '2024/2025',
                'tahun_mulai' => 2024,
                'tahun_selesai' => 2025,
                'status' => 'nonaktif',
                'tanggal_mulai' => '2024-07-01',
                'tanggal_selesai' => '2025-06-30',
                'keterangan' => 'Tahun ajaran 2024/2025',
            ],
            [
                'tahun_ajar' => '2025/2026',
                'tahun_mulai' => 2025,
                'tahun_selesai' => 2026,
                'status' => 'aktif',
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2026-06-30',
                'keterangan' => 'Tahun ajaran 2025/2026 (Aktif)',
            ],
        ];

        foreach ($tahunAjars as $ta) {
            TahunAjar::firstOrCreate(
                ['tahun_ajar' => $ta['tahun_ajar']],
                $ta
            );
        }
    }
}
