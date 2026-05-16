<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ortu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SidiniSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Siswa data
        Siswa::create([
            'nis' => '001',
            'nik' => '3273050510050001',
            'nama_siswa' => 'Andi Pratama',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2005-10-05',
            'alamat' => 'Jalan Merdeka No. 1, Bandung',
            'no_hp' => '081234567890',
            'email' => 'andi@example.com',
            'username' => '001',
            'password' => Hash::make('001'),
            'gambar' => null,
        ]);

        Siswa::create([
            'nis' => '002',
            'nik' => '3273050510050002',
            'nama_siswa' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2005-06-15',
            'alamat' => 'Jalan Ahmad Yani No. 5, Jakarta',
            'no_hp' => '082345678901',
            'email' => 'budi@example.com',
            'username' => '002',
            'password' => Hash::make('002'),
            'gambar' => null,
        ]);

        // Seed Guru data
        Guru::create([
            'nip' => '196203081991031001',
            'nik' => '3273051963030001',
            'nama_guru' => 'Drs. Hendra Wijaya',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1962-03-08',
            'alamat' => 'Jalan Sudirman No. 10, Bandung',
            'no_hp' => '081234567890',
            'email' => 'hendra@example.com',
            'username' => '196203081991031001',
            'password' => Hash::make('196203081991031001'),
            'gambar' => null,
            'jabatan' => 'guru',
        ]);

        Guru::create([
            'nip' => '196512051990032002',
            'nik' => '3273051965120002',
            'nama_guru' => 'Dra. Siti Nurhaliza',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '1965-12-05',
            'alamat' => 'Jalan Pemuda No. 20, Surabaya',
            'no_hp' => '082345678901',
            'email' => 'siti@example.com',
            'username' => 'guru',
            'password' => Hash::make('guru'),
            'gambar' => null,
            'jabatan' => 'guru',
        ]);

        // Seed Admin (Guru dengan jabatan admin)
        Guru::create([
            'nip' => '196405021992012003',
            'nik' => '3273051964050003',
            'nama_guru' => 'Bapak Muhammad Rifqi',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Medan',
            'tanggal_lahir' => '1964-05-02',
            'alamat' => 'Jalan Gatot Subroto No. 15, Medan',
            'no_hp' => '083456789012',
            'email' => 'rifqi@example.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'gambar' => null,
            'jabatan' => 'admin',
        ]);

        // Seed Kepsek (Guru dengan jabatan kepala_sekolah)
        Guru::create([
            'nip' => '195907011987031004',
            'nik' => '3273051959070004',
            'nama_guru' => 'Prof. Dr. Sudarno, M.Pd',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Yogyakarta',
            'tanggal_lahir' => '1959-07-01',
            'alamat' => 'Jalan Diponegoro No. 25, Yogyakarta',
            'no_hp' => '084567890123',
            'email' => 'sudarno@example.com',
            'username' => '195907011987031004',
            'password' => Hash::make('195907011987031004'),
            'gambar' => null,
            'jabatan' => 'kepala_sekolah',
        ]);

        // Seed Ortu data
        Ortu::create([
            'nik' => '3273051965120005',
            'nama_ortu' => 'Haji Mochtar',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1965-12-12',
            'alamat' => 'Jalan Merdeka No. 1, Bandung',
            'no_hp' => '081234567891',
            'email' => 'haji@example.com',
            'username' => '3273051965120005',
            'password' => Hash::make('3273051965120005'),
            'gambar' => null,
        ]);

        Ortu::create([
            'nik' => '3273051960080006',
            'nama_ortu' => 'Ibu Nurjannah',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1960-08-20',
            'alamat' => 'Jalan Ahmad Yani No. 5, Jakarta',
            'no_hp' => '082345678902',
            'email' => 'nurjannah@example.com',
            'username' => '3273051960080006',
            'password' => Hash::make('3273051960080006'),
            'gambar' => null,
        ]);
    }
}
