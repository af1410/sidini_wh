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
        Schema::create('kelas_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelas', 100);
            $table->string('id_mapel', 100);
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapel')->onDelete('cascade');
            $table->unique(['id_kelas', 'id_mapel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_mapel');
    }
};
