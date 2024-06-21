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
        Schema::create('presensi_siswas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');            
            $table->bigInteger('jurusan_id');            
            $table->enum('ket_ketidakhadiran',['Tidak Ada','Sakit','Izin','Tanpa Keterangan'])->default('Tidak Ada');
            $table->enum('jumlah_hari',['0 Hari','1 Hari','2 Hari','3 Hari','4 Hari','Lainnya'])->default('0 Hari');
            $table->string('jumlah_hari_lainnya');
            $table->bigInteger('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_siswas');
    }
};
