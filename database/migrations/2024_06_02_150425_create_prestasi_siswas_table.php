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
        Schema::create('prestasi_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('jurusan_id');
            $table->enum('ket_prestasi', ['Tingkat Internasional Juara 1', 'Tingkat Internasional Juara 2', 'Tingkat Internasional Juara 3', 'Tingkat Nasional Juara 1', 'Tingkat Nasional Juara 2', 'Tingkat Nasional Juara 3', 'Tingkat Provinsi Juara 1', 'Tingkat Provinsi Juara 2', 'Tingkat Provinsi Juara 3', 'Tingkat Kabupaten/Kota Juara 1', 'Tingkat Kabupaten/Kota Juara 2', 'Tingkat Kabupaten/Kota Juara 3', 'Tidak Ada'])->default('Tidak Ada');
            $table->bigInteger('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswas');
    }
};
