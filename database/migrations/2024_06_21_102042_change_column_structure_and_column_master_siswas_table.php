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
        Schema::table('master_siswas', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->string('name')->after('id');
            $table->string('email')->unique()->after('id');
            $table->string('periode',25)->after('jenkel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
