<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilai_akhir', function (Blueprint $table) {
            $table->decimal('rata_bab_formatif', 5, 2)->nullable()->after('rata_bab');
        });
    }
    public function down(): void
    {
        Schema::table('nilai_akhir', function (Blueprint $table) {
            $table->dropColumn('rata_bab_formatif');
        });
    }
};
