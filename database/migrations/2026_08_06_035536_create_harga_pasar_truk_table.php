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
    Schema::create('harga_pasar_truk', function (Blueprint $table) {
        $table->id();
        $table->string('nama_tipe_truk');
        $table->float('max_kondisi_fisik')->default(100);
        $table->double('min_biaya_penanganan'); // Kriteria Cost
        $table->double('max_nilai_jual');        // Kriteria Benefit
        $table->double('max_nilai_sparepart');   // Kriteria Benefit
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_pasar_truk');
    }
};
