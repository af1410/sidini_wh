<?php

namespace Database\Seeders;

use App\Models\Mapel;
use App\Models\TahunAjar;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAjar = TahunAjar::where('status', 'aktif')->first();

        if (!$tahunAjar) {
            $this->command->error('Tahun ajar aktif tidak ditemukan.');
            return;
        }

        $mapels = [

            // =======================
            // UMUM
            // =======================

            [
                'id_mapel' => 'MU2627001',
                'nama_mapel' => 'Pendidikan Pancasila',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627002',
                'nama_mapel' => 'Bahasa Indonesia',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627003',
                'nama_mapel' => 'Bahasa Inggris',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627004',
                'nama_mapel' => 'Al-Qur\'an Hadis',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627005',
                'nama_mapel' => 'Akidah Akhlak',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627006',
                'nama_mapel' => 'Fikih',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627007',
                'nama_mapel' => 'Sejarah Kebudayaan Islam',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627008',
                'nama_mapel' => 'Bahasa Arab',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627009',
                'nama_mapel' => 'Sejarah Indonesia',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627010',
                'nama_mapel' => 'PJOK',
                'jenis_mapel' => 'umum',
            ],
            [
                'id_mapel' => 'MU2627011',
                'nama_mapel' => 'Seni Budaya',
                'jenis_mapel' => 'umum',
            ],

            // =======================
            // MINAT IPA
            // =======================

            [
                'id_mapel' => 'MM2627012',
                'nama_mapel' => 'Fisika',
                'jenis_mapel' => 'minat',
            ],
            [
                'id_mapel' => 'MM2627013',
                'nama_mapel' => 'Kimia',
                'jenis_mapel' => 'minat',
            ],

            // =======================
            // MINAT IPS
            // =======================

            [
                'id_mapel' => 'MM2627014',
                'nama_mapel' => 'Ekonomi',
                'jenis_mapel' => 'minat',
            ],
            [
                'id_mapel' => 'MM2627015',
                'nama_mapel' => 'Geografi',
                'jenis_mapel' => 'minat',
            ],
            [
                'id_mapel' => 'MM2627016',
                'nama_mapel' => 'Sosiologi',
                'jenis_mapel' => 'minat',
            ],

        ];

        foreach ($mapels as $item) {

            // Jangan buat jika sudah ada berdasarkan nama mapel
            if (Mapel::where('nama_mapel', $item['nama_mapel'])->exists()) {
                continue;
            }

            Mapel::create([
                'id_mapel'       => $item['id_mapel'],
                'nama_mapel'     => $item['nama_mapel'],
                'jenis_mapel'    => $item['jenis_mapel'],
                'tahun_ajaran'   => $tahunAjar->tahun_ajar,
                'id_tahun_ajar'  => $tahunAjar->id_tahun_ajar,
            ]);
        }

        $this->command->info('Seeder mapel berhasil dijalankan.');
    }
}
