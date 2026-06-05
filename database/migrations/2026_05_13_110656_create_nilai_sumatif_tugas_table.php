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
        Schema::create('nilai_sumatif_tugas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sumatif');
            $table->string('nama_tugas', 150);
            $table->unsignedTinyInteger('urutan_tugas')->default(1);
            $table->decimal('nilai', 5, 2)->default(0);
            $table->timestamps();

            $table->foreign('id_sumatif')->references('id')->on('nilai_sumatif')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sumatif_tugas');
    }
};
