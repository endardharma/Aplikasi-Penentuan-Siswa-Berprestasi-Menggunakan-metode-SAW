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
        Schema::table('presensi_siswas', function (Blueprint $table) {
            $table->dropColumn(['ket_ketidakhadiran', 'jumlah_hari', 'jumlah_hari_lainnya']);
        
            // Tambahkan kolom konversi_ketidakhadiran_id
            $table->bigInteger('konversi_ketidakhadiran_id')->after('jurusan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presensi_siswas', function (Blueprint $table) {
            //
        });
    }
};
