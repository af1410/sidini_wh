<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (!Schema::hasColumn('siswa', 'kelas')) {
                $table->string('kelas')->nullable()->after('username');
            }
            if (!Schema::hasColumn('siswa', 'angkatan')) {
                $table->string('angkatan')->nullable()->after('kelas');
            }
            if (!Schema::hasColumn('siswa', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('angkatan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            if (Schema::hasColumn('siswa', 'jurusan')) {
                $table->dropColumn('jurusan');
            }
            if (Schema::hasColumn('siswa', 'angkatan')) {
                $table->dropColumn('angkatan');
            }
            if (Schema::hasColumn('siswa', 'kelas')) {
                $table->dropColumn('kelas');
            }
        });
    }
};
