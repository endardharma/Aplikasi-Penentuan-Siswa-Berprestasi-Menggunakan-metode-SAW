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
        Schema::table('master_kriterias', function (Blueprint $table) {
            $table->dropColumn('kurikulum');

            $table->bigInteger('tajar_id')->after('bobot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_kriterias', function (Blueprint $table) {
            //
        });
    }
};
