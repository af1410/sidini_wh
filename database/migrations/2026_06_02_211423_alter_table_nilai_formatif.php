<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai_formatif', function (Blueprint $table) {
            if (Schema::hasColumn('nilai_formatif', 'nilai_uas')) {
                $table->renameColumn('nilai_uas', 'nilai_formatif');
            }

            if (!Schema::hasColumn('nilai_formatif', 'bab_ke')) {
                $table->unsignedTinyInteger('bab_ke')->after('id_siswa');
            }

            if (!Schema::hasColumn('nilai_formatif', 'pertemuan_ke')) {
                $table->unsignedSmallInteger('pertemuan_ke')->after('bab_ke');
            }

            if (!Schema::hasColumn('nilai_formatif', 'tanggal_input')) {
                $table->date('tanggal_input')->after('pertemuan_ke');
            }

            $table->unique(
                ['id_penilaian', 'id_siswa', 'bab_ke', 'pertemuan_ke'],
                'nilai_formatif_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('nilai_formatif', function (Blueprint $table) {
            $table->dropUnique('nilai_formatif_unique');

            if (Schema::hasColumn('nilai_formatif', 'tanggal_input')) {
                $table->dropColumn('tanggal_input');
            }

            if (Schema::hasColumn('nilai_formatif', 'pertemuan_ke')) {
                $table->dropColumn('pertemuan_ke');
            }

            if (Schema::hasColumn('nilai_formatif', 'bab_ke')) {
                $table->dropColumn('bab_ke');
            }

            if (Schema::hasColumn('nilai_formatif', 'nilai_formatif')) {
                $table->renameColumn('nilai_formatif', 'nilai_uas');
            }
        });
    }
};
