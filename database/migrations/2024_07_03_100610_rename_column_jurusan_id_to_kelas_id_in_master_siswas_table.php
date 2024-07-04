<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('master_siswas', function (Blueprint $table) {
            DB::statement('ALTER TABLE master_siswas CHANGE jurusan_id kelas_id BIGINT');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_siswas', function (Blueprint $table) {
            //
        });
    }
};
