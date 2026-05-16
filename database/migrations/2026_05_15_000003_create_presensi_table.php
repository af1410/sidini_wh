<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->enum('status', ['Hadir', 'Alpha', 'Izin', 'Sakit'])->default('Hadir');
            $table->timestamps();

            $table->unique(['id_siswa', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
