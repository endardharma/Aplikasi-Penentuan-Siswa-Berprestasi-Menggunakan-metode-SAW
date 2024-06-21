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
        Schema::create('sikap_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('jurusan_id');
            $table->enum('ket_sikap',['Sangat Baik','Baik','Cukup','Tidak Baik','Sangat Tidak Baik'])->default('Baik');
            $table->bigInteger('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sikap_siswas');
    }
};
