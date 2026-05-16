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
        Schema::create('nilai_akhir', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->string('id_mapel', 100);
            $table->string('semester', 20);

            $table->decimal('bobot_formatif', 5, 2)->default(40);
            $table->decimal('bobot_sumatif', 5, 2)->default(60);

            $table->decimal('nilai_formatif', 5, 2)->default(0);
            $table->decimal('nilai_sumatif', 5, 2)->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);

            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapel')->onDelete('cascade');

            $table->unique(['id_siswa', 'id_mapel', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_akhir');
    }
};
