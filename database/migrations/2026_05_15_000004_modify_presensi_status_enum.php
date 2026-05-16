<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE presensi MODIFY status ENUM('Hadir','Terlambat','Alpha','Izin','Sakit') NOT NULL DEFAULT 'Hadir';");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE presensi MODIFY status ENUM('Hadir','Alpha','Izin','Sakit') NOT NULL DEFAULT 'Hadir';");
    }
};
