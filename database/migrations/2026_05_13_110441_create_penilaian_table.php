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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru');
            $table->string('id_mapel', 100);
            $table->string('id_kelas', 100);
            $table->string('semester', 20);
            $table->enum('jenis_penilaian', ['formatif', 'sumatif']);
            $table->unsignedInteger('bab_ke')->nullable();
            $table->string('judul_bab', 150)->nullable();
            $table->dateTime('tanggal_mulai')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->enum('status_buka', ['dibuka', 'ditutup'])->default('dibuka');
            $table->enum('status_approval', ['normal', 'menunggu_approval', 'disetujui', 'ditolak', 'publish'])->default('normal');
            $table->unsignedBigInteger('dibuka_oleh');
            $table->unsignedBigInteger('approved_oleh')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_guru')->references('id_guru')->on('guru')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapel')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
