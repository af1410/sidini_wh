<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = DB::select("SHOW INDEX FROM nilai_formatif");
        $indexNames = collect($indexes)->pluck('Key_name')->unique()->values()->toArray();
        Schema::table('nilai_formatif', function (Blueprint $table) use ($indexNames) {
            if (in_array('nilai_formatif_id_penilaian_id_siswa_unique', $indexNames)) {
                $table->dropUnique('nilai_formatif_id_penilaian_id_siswa_unique');
            }
        });
        $indexes = DB::select("SHOW INDEX FROM nilai_formatif");
        $indexNames = collect($indexes)->pluck('Key_name')->unique()->values()->toArray();
        if (!in_array('nilai_formatif_unique', $indexNames)) {
            Schema::table('nilai_formatif', function (Blueprint $table) {
                $table->unique(['id_penilaian', 'id_siswa', 'bab_ke', 'pertemuan_ke'], 'nilai_formatif_unique');
            });
        }
    }
    public function down(): void
    {
        $indexes = DB::select("SHOW INDEX FROM nilai_formatif");
        $indexNames = collect($indexes)->pluck('Key_name')->unique()->values()->toArray();
        Schema::table('nilai_formatif', function (Blueprint $table) use ($indexNames) {
            if (in_array('nilai_formatif_unique', $indexNames)) {
                $table->dropUnique('nilai_formatif_unique');
            }
        });
        $indexes = DB::select("SHOW INDEX FROM nilai_formatif");
        $indexNames = collect($indexes)->pluck('Key_name')->unique()->values()->toArray();
        if (!in_array('nilai_formatif_id_penilaian_id_siswa_unique', $indexNames)) {
            Schema::table('nilai_formatif', function (Blueprint $table) {
                $table->unique(['id_penilaian', 'id_siswa'], 'nilai_formatif_id_penilaian_id_siswa_unique');
            });
        }
    }
};
