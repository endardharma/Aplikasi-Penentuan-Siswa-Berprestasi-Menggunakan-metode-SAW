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
        Schema::table('sikap_siswas', function (Blueprint $table) {
            $table->dropColumn('ket_sikap', 'nilai');
            $table->bigInteger('konversi_sikap_id')->after('jurusan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sikap_siswas', function (Blueprint $table) {
            //
        });
    }
};
