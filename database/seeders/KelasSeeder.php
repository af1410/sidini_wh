<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjar;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $tahunAjar = TahunAjar::where('status', 'aktif')->first();

        if (!$tahunAjar) {
            $this->command->error('Tahun ajar aktif tidak ditemukan.');
            return;
        }

        // Ambil 6 guru secara acak (tidak termasuk kepala sekolah)
        $gurus = Guru::where('jabatan', 'guru')
            ->inRandomOrder()
            ->limit(6)
            ->get()
            ->values();

        $kelasData = [
            ['kelas' => 'X', 'rombel' => 'A'],
            ['kelas' => 'X', 'rombel' => 'B'],
            ['kelas' => 'XI', 'rombel' => 'A'],
            ['kelas' => 'XI', 'rombel' => 'B'],
            ['kelas' => 'XII', 'rombel' => 'A'],
            ['kelas' => 'XII', 'rombel' => 'B'],
        ];

        foreach ($kelasData as $index => $item) {

            // ==========================
            // Generate ID Kelas
            // ==========================

            $prefixKelas = 'K';

            $prefixTingkat = strtoupper($item['kelas']);

            // 2025-2026 -> 2526
            $tahun = str_replace(
                '-',
                '',
                substr($tahunAjar->tahun_ajar, 2, 2) .
                    substr($tahunAjar->tahun_ajar, 7, 2)
            );

            $prefix = $prefixKelas . $prefixTingkat . $tahun;

            $lastKelas = Kelas::where('id_kelas', 'like', $prefix . '%')
                ->orderBy('id_kelas', 'desc')
                ->first();

            if ($lastKelas) {
                $lastNumber = (int) substr($lastKelas->id_kelas, -3);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $idKelas = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            // ==========================
            // Simpan
            // ==========================

            Kelas::create([
                'id_kelas'       => $idKelas,
                'tahun_ajar'     => $tahunAjar->tahun_ajar,
                'kelas'          => $item['kelas'],
                'rombel'         => $item['rombel'],
                'nama_kelas'     => $item['kelas'] . ' ' . $item['rombel'],
                'id_guru'        => $gurus[$index]->id_guru,
                'id_tahun_ajar'  => $tahunAjar->id_tahun_ajar,
            ]);
        }

        $this->command->info('Seeder kelas berhasil dijalankan.');
    }
}
