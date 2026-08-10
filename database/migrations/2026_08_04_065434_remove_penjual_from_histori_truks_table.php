<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('histori_truks', function (Blueprint $table) {
        $table->dropColumn('penjual');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histori_truks', function (Blueprint $table) {
            //
        });
    }
};
