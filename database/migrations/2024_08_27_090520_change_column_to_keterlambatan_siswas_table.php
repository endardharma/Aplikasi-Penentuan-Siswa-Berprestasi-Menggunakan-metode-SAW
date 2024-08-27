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
        Schema::table('keterlambatan_siswas', function (Blueprint $table) {
            $table->bigInteger('konversi_keterlambatan_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keterlambatan_siswas', function (Blueprint $table) {
            //
        });
    }
};
