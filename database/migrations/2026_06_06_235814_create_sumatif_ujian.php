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
        Schema::create('nilai_sumatif_ujian', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('id_penilaian');
            $table->unsignedBigInteger('id_siswa');

            $table->decimal('nilai_ujian', 5, 2)->default(0);

            $table->timestamps();

            $table->foreign('id_penilaian')
                ->references('id')
                ->on('penilaian')
                ->onDelete('cascade');

            $table->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sumatif_ujian');
    }
};
