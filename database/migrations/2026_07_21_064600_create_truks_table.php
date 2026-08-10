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
        Schema::create('truks', function (Blueprint $table) {
            $table->id('id_truk');
            $table->string('kode_truk')->unique();
            $table->string('merk');
            $table->string('tipe');
            $table->string('nomor_plat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truks');
    }
};
