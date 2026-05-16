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
        Schema::table('mapel', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru')->nullable()->after('tahun_ajaran');
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mapel', function (Blueprint $table) {
            $table->dropForeign(['id_guru']);
            $table->dropColumn('id_guru');
        });
    }
};
