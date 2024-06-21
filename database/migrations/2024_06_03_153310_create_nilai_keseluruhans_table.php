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
        Schema::create('nilai_keseluruhans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('jurusan_id');
            $table->bigInteger('kriteria_id');
            $table->bigInteger('nilai');
            $table->bigInteger('total_nilai');
            $table->bigInteger('rapor_id');
            $table->bigInteger('ketidakhadiran_id');
            $table->bigInteger('sikap_id');
            $table->bigInteger('prestasi_id');
            $table->bigInteger('keterlambatan_id');
            $table->bigInteger('hafalan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_keseluruhans');
    }
};
