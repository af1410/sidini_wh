<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_siswa');
            $table->string('id_kelas');
            $table->unsignedBigInteger('id_tahun_ajar');

            $table->enum('status', [
                'aktif',
                'naik kelas',
                'lulus',
                'selesai'
            ])->default('aktif');

            $table->timestamps();

            $table->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa')
                ->cascadeOnDelete();

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('kelas')
                ->cascadeOnDelete();



            $table->foreign('id_tahun_ajar')
                ->references('id_tahun_ajar')
                ->on('tahun_ajar')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};
