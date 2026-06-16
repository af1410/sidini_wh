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

            $table->string('id_mapel');
            $table->string('id_kelas');

            $table->string('semester', 20);

            $table->decimal('bobot_bab', 5, 2)->default(40);
            $table->decimal('bobot_psts', 5, 2)->default(30);
            $table->decimal('bobot_psas', 5, 2)->default(30);

            $table->decimal('rata_bab', 5, 2)->default(0);
            $table->decimal('nilai_psts', 5, 2)->default(0);
            $table->decimal('nilai_psas', 5, 2)->default(0);

            $table->decimal('nilai_akhir', 5, 2)->default(0);

            $table->timestamps();
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
