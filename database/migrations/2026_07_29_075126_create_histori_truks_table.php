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
    Schema::create('histori_truks', function (Blueprint $table) {
        $table->id();
        $table->string('plat_nomor'); // T001, T002, dst.
        $table->string('merk_tipe');  // Colt Diesel PS100, Toyota Dyna, dll.
        $table->integer('tahun');
        $table->string('penjual');
        $table->integer('kondisi');
        $table->decimal('biaya_penanganan', 15, 2);
        $table->decimal('nilai_jual', 15, 2);
        $table->decimal('nilai_suku_cadang', 15, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_truks');
    }
};
