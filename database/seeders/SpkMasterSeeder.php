<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpkMasterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Kriteria (C1 - C4)
        DB::table('kriterias')->insert([
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Kondisi Fisik Truk Bekas',
                'jenis'         => 'benefit',
                'bobot'         => 0.25, // Sesuaikan dengan persentase bobot kamu
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Biaya Penanganan',
                'jenis'         => 'cost',
                'bobot'         => 0.25, // Sesuaikan dengan persentase bobot kamu
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Nilai Jual Truk Bekas',
                'jenis'         => 'benefit',
                'bobot'         => 0.25, // Sesuaikan dengan persentase bobot kamu
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Nilai Suku Cadang',
                'jenis'         => 'benefit',
                'bobot'         => 0.25, // Sesuaikan dengan persentase bobot kamu
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);

        // 2. Data Alternatif Strategi (A1 - A3)
        DB::table('alternatifs')->insert([
            [
                'kode_alternatif' => 'A1',
                'nama_alternatif' => 'Langsung Dijual',
                'keterangan'      => 'Truk masih dalam kondisi baik sehingga dapat langsung dijual tanpa perbaikan.',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'kode_alternatif' => 'A2',
                'nama_alternatif' => 'Diperbaiki Kemudian Dijual',
                'keterangan'      => 'Truk mengalami kerusakan yang masih layak diperbaiki agar nilai jual meningkat.',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'kode_alternatif' => 'A3',
                'nama_alternatif' => 'Dibongkar Menjadi Suku Cadang',
                'keterangan'      => 'Truk sudah tidak layak dijual utuh sehingga dibongkar dan dijual sebagai spare part.',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

        // 3. Data Sampel Truk yang Diteliti
        DB::table('truks')->insert([
            [
                'kode_truk'  => 'TRK-001',
                'merk'       => 'Mitsubishi',
                'tipe'       => 'Colt Diesel PS 100',
                'nomor_plat' => 'BK 8123 AB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_truk'  => 'TRK-002',
                'merk'       => 'Toyota',
                'tipe'       => 'Dyna 130 HT',
                'nomor_plat' => 'BK 9012 CD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_truk'  => 'TRK-003',
                'merk'       => 'Isuzu',
                'tipe'       => 'Elf NKR 71',
                'nomor_plat' => 'BK 7341 EF',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
