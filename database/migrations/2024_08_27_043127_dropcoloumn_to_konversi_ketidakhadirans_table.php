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
        Schema::table('konversi_ketidakhadirans', function (Blueprint $table) {
            $table->dropColumn(['jumlah_hari_lainnya']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konversi_ketidakhadirans', function (Blueprint $table) {
            //
        });
    }
};
