<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaDummySeeder extends Seeder
{
    public function run(): void
    {
        $namaDepan = [
            'Ahmad',
            'Muhammad',
            'Abdul',
            'Fajar',
            'Rizky',
            'Bagas',
            'Dimas',
            'Farhan',
            'Ilham',
            'Rafi',
            'Yoga',
            'Aldi',
            'Reza',
            'Andi',
            'Naufal',
            'Aisyah',
            'Siti',
            'Putri',
            'Nabila',
            'Aulia',
            'Anisa',
            'Nur',
            'Rina',
            'Dewi',
            'Intan'
        ];

        $namaBelakang = [
            'Pratama',
            'Saputra',
            'Firmansyah',
            'Maulana',
            'Ramadhan',
            'Kurniawan',
            'Permana',
            'Hidayat',
            'Wijaya',
            'Santoso',
            'Nugraha',
            'Akbar',
            'Hakim',
            'Fauzan',
            'Lestari',
            'Rahmawati',
            'Utami',
            'Amelia',
            'Sari',
            'Safitri'
        ];

        $asalSekolah = [
            'MTs Wasilatul Huda',
            'MTs Negeri 1 Garut',
            'MTs Al-Hidayah',
            'SMP Negeri 1 Garut',
            'SMP Negeri 2 Garut',
            'SMP Negeri 3 Garut',
            'SMP Islam Terpadu',
            'SMP Plus Al-Ma\'soem',
            'MTs Persis',
            'SMP Muhammadiyah'
        ];

        for ($i = 1; $i <= 70; $i++) {

            $nim = 20270000 + $i;

            $nama = $namaDepan[array_rand($namaDepan)]
                . ' ' .
                $namaBelakang[array_rand($namaBelakang)];

            $email = 'siswa' . $nim . '@mail.com';

            Siswa::create([

                'nim' => $nim,

                'nisn' => '999' . str_pad($i, 7, '0', STR_PAD_LEFT),

                'nik' => '3205' . str_pad($i, 12, '0', STR_PAD_LEFT),

                'nama_siswa' => $nama,

                'jenis_kelamin' => rand(0, 1)
                    ? 'Laki-laki'
                    : 'Perempuan',

                'tempat_lahir' => 'Garut',

                'tanggal_lahir' => now()
                    ->subYears(rand(15, 17))
                    ->subDays(rand(1, 365)),

                'agama' => 'Islam',

                'alamat' => 'Jl. Raya Garut No. ' . rand(1, 250),

                'no_hp' => '0812' . rand(10000000, 99999999),

                'email' => $email,

                'username' => explode('@', $email)[0],

                'uid_kartu' => null,

                'password' => Hash::make('01012010'),

                'gambar' => null,

                'id_kelas' => null,

                'status' => 'aktif',

                'angkatan' => 2027,

                'asal_sekolah' => $asalSekolah[array_rand($asalSekolah)]

            ]);
        }

        $this->command->info('70 data siswa dummy berhasil dibuat.');
    }
}
