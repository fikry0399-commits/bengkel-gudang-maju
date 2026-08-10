<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HargaPasarTrukSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan tabel dulu agar tidak duplicate entry saat di-seed ulang
        DB::table('harga_pasar_truk')->truncate();

        DB::table('harga_pasar_truk')->insert([
    [
        'nama_tipe_truk'        => 'Colt Diesel',
        'max_kondisi_fisik'     => 100,
        'min_biaya_penanganan'  => 3000000,
        'max_nilai_jual'        => 75000000,
        'max_nilai_sparepart'   => 35000000, 
        'created_at'            => now(),
        'updated_at'            => now(),
    ],
    [
        'nama_tipe_truk'        => 'Toyota Dyna',
        'max_kondisi_fisik'     => 100,
        'min_biaya_penanganan'  => 3500000,
        'max_nilai_jual'        => 80000000,
        'max_nilai_sparepart'   => 38000000, 
        'created_at'            => now(),
        'updated_at'            => now(),
    ],
    [
        'nama_tipe_truk'        => 'Isuzu Elf',
        'max_kondisi_fisik'     => 100,
        'min_biaya_penanganan'  => 3000000,
        'max_nilai_jual'        => 70000000,
        'max_nilai_sparepart'   => 30000000,
        'created_at'            => now(),
        'updated_at'            => now(),
    ],
]);
    }
}