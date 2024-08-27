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
            $table->dropColumn('jumlah_keterlambatan', 'nilai');

            $table->bigInteger('konversi_prestasi_id')->after('jurusan_id');
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
