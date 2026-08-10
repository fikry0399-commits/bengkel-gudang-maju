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
    Schema::create('penilaians', function (Blueprint $table) {
        $table->id('id_penilaian');
        
        // Relasi ke Truk, Alternatif, dan Kriteria
        $table->foreignId('id_truk')->constrained('truks', 'id_truk')->onDelete('cascade');
        $table->foreignId('id_alternatif')->constrained('alternatifs', 'id_alternatif')->onDelete('cascade');
        $table->foreignId('id_kriteria')->constrained('kriterias', 'id_kriteria')->onDelete('cascade');
        
        $table->double('nilai'); // Nilai skor input (misal: 1-5 atau nilai rupiah/kondisi)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_alternatifs');
    }
};
