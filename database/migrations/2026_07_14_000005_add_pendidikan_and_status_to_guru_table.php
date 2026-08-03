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
        Schema::table('guru', function (Blueprint $table) {
            if (!Schema::hasColumn('guru', 'pendidikan')) {
                $table->string('pendidikan', 100)->nullable()->after('jabatan');
            }
            if (!Schema::hasColumn('guru', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('pendidikan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            if (Schema::hasColumn('guru', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('guru', 'pendidikan')) {
                $table->dropColumn('pendidikan');
            }
        });
    }
};
