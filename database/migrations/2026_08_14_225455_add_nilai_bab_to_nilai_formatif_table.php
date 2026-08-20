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
        Schema::table('nilai_formatif', function (Blueprint $table) {
            $table->decimal('nilai_bab', 5, 2)
                ->nullable()
                ->after('nilai_formatif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_formatif', function (Blueprint $table) {
            $table->dropColumn('nilai_bab');
        });
    }
};
