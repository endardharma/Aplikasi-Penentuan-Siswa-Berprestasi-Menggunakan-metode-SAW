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
            // Ubah tipe data kolom (contoh: dari string ke integer)
            $table->string('jumlah_hari')->change();
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
