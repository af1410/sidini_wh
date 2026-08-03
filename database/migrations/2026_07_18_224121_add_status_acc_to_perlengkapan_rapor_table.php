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
        Schema::table('perlengkapan_rapor', function (Blueprint $table) {

            $table->foreignId('id_tahun_ajar')
                ->nullable()
                ->after('id_kelas')
                ->constrained('tahun_ajar', 'id_tahun_ajar')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->enum('status_acc', [
                'menunggu',
                'disetujui',
                'ditolak'
            ])->default('menunggu')
                ->after('catatan_wali_kelas');

            $table->timestamp('approved_at')
                ->nullable()
                ->after('status_acc');

            $table->string('approved_by')
                ->nullable()
                ->after('approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perlengkapan_rapor', function (Blueprint $table) {

            $table->dropColumn([
                'id_tahun_ajar',
                'status_acc',
                'approved_at',
                'approved_by'
            ]);
        });
    }
};
