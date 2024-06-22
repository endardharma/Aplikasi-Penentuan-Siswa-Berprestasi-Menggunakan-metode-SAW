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
        Schema::create('nilai_perangkingans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tajar_id');
            $table->bigInteger('siswa_id');
            $table->bigInteger('jurusan_id');
            $table->float('nilai_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_perangkingans');
    }
};
