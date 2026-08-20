<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HapusSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $idPenilaian = [98, 99, 100, 101];
            DB::table('nilai_sumatif_ujian')
                ->whereIn('id_penilaian', $idPenilaian)
                ->delete();
            DB::table('penilaian')
                ->whereIn('id', $idPenilaian)
                ->delete();
            DB::table('nilai_akhir')
                ->where('id_mapel', 'MM2627001')
                ->where('id_kelas', 'KX2526002')
                ->where('semester', 'ganjil')
                ->delete();
        });
    }
}
