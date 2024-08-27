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
        Schema::create('konversi_keterlambatans', function (Blueprint $table) {
            $table->id();
            $table->enum('jumlah_keterlambatan', ['0 Kali','1-2 Kali','3-4 Kali', '5-6 Kali', '> 7 Kali'])->default('0 Kali');
            $table->bigInteger('nilai_konversi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konversi_keterlambatans');
    }
};
