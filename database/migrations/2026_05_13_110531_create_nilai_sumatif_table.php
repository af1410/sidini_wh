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
        Schema::create('nilai_sumatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penilaian');
            $table->unsignedBigInteger('id_siswa');

            $table->decimal('nilai_tes_tulis', 5, 2)->default(0);
            $table->decimal('nilai_kehadiran', 5, 2)->default(0);

            $table->decimal('bobot_tes_tulis', 5, 2)->default(0);
            $table->decimal('bobot_tugas', 5, 2)->default(0);
            $table->decimal('bobot_kehadiran', 5, 2)->default(0);

            $table->decimal('nilai_bab', 5, 2)->default(0);
            $table->enum('status_data', ['draft', 'submitted', 'menunggu_approval', 'approved', 'ditolak'])->default('submitted');
            $table->timestamps();

            $table->foreign('id_penilaian')->references('id')->on('penilaian')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');

            $table->unique(['id_penilaian', 'id_siswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sumatif');
    }
};
