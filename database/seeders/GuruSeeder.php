<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $guru = [

            [
                'nama_guru' => 'Idham Maulana, M.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-2',
                'jabatan' => 'kepala_sekolah',
            ],

            [
                'nama_guru' => 'Solihin, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Euis Maulan, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Ir. Wiwik Suwiyandani',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Mira Sugiartini, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Aceng Kamaludin, S.Ag',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Elis, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Ajat Sudrajat, S.Kom',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Deni Handayani, M.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-2',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Robi Yana, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Nunung Julaeha, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Nandar Mulyono, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Arif Budiman, S.HI',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Yana Suryana, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Sri Marlina, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Agus Ramdani, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Yogi Kusnandar, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Jana Sujana, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Asep Sodikin, S.Ag',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Papat Fatimah Fitriani, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Elinda Maryawati, S.Pd',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Hanipah Nur Pirdaus, S.E',
                'jenis_kelamin' => 'Perempuan',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

            [
                'nama_guru' => 'Tandhimul Haq, S.Pd',
                'jenis_kelamin' => 'Laki-laki',
                'pendidikan' => 'S-1',
                'jabatan' => 'guru',
            ],

        ];

        foreach ($guru as $i => $item) {

            $email = 'guru' . ($i + 1) . '@mail.com';

            Guru::create([

                'nip' => '19850' . str_pad($i + 1, 13, '0', STR_PAD_LEFT),

                'nik' => '3205' . str_pad($i + 1, 12, '0', STR_PAD_LEFT),

                'nama_guru' => $item['nama_guru'],

                'jenis_kelamin' => $item['jenis_kelamin'],

                'tempat_lahir' => 'Garut',

                'tanggal_lahir' => now()->subYears(rand(28, 55))->subDays(rand(1, 365)),

                'alamat' => 'Garut',

                'no_hp' => '0812' . rand(10000000, 99999999),

                'email' => $email,

                'username' => explode('@', $email)[0],

                'password' => Hash::make('01011990'),

                'gambar' => null,

                'jabatan' => $item['jabatan'],

                'pendidikan' => $item['pendidikan'],

                'status' => 'aktif',

            ]);
        }
    }
}
