<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('penilaian', 'id_tahun_ajar')) {
                $table->unsignedBigInteger('id_tahun_ajar')->nullable()->after('id');
                $table->foreign('id_tahun_ajar')->references('id_tahun_ajar')->on('tahun_ajar')->onDelete('restrict');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {
            if (Schema::hasColumn('penilaian', 'id_tahun_ajar')) {
                $table->dropForeign(['id_tahun_ajar']);
                $table->dropColumn('id_tahun_ajar');
            }
        });
    }
};
