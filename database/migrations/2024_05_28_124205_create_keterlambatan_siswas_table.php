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
        Schema::create('keterlambatan_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('jurusan_id');
            $table->enum('jumlah_keterlambatan', ['0 Kali','1-2 Kali','3-4 Kali', '5-6 Kali', '> 7 Kali'])->default('0 Kali');
            $table->bigInteger('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keterlambatan_siswas');
    }
};
