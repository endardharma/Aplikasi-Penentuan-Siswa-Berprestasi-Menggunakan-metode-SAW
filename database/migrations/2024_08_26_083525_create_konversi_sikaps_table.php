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
        Schema::create('konversi_sikaps', function (Blueprint $table) {
            $table->id();
            $table->enum('ket_sikap',['Sangat Baik','Baik','Cukup','Tidak Baik','Sangat Tidak Baik'])->default('Baik');
            $table->bigInteger('nilai_konversi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversi_sikaps');
    }
};
