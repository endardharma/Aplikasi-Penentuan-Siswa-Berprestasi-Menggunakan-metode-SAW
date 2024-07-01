<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tahun_ajars', function (Blueprint $table) {
            DB::statement('ALTER TABLE tahun_ajars CHANGE tahun periode VARCHAR(255)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tahun_ajars', function (Blueprint $table) {
        });
    }
};
