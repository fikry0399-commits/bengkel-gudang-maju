<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoriTruk;

class HistoriTrukSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan data lama agar tidak bentrok
        HistoriTruk::truncate();

       $data = [
        ['plat_nomor' => 'BK 8492 XF', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2015, 'kondisi' => 53, 'biaya_penanganan' => 3300000, 'nilai_jual' => 54500000, 'nilai_suku_cadang' => 32500000], // Serdang Bedagai (X)
        ['plat_nomor' => 'BK 9105 WB', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2016, 'kondisi' => 56, 'biaya_penanganan' => 4600000, 'nilai_jual' => 59000000, 'nilai_suku_cadang' => 35000000],   // Pematangsiantar (W)
        ['plat_nomor' => 'BK 9381 MK', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2017, 'kondisi' => 59, 'biaya_penanganan' => 5900000, 'nilai_jual' => 63500000, 'nilai_suku_cadang' => 37500000],  // Deli Serdang (M)
        ['plat_nomor' => 'BK 8047 VT', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2018, 'kondisi' => 62, 'biaya_penanganan' => 7200000, 'nilai_jual' => 68000000, 'nilai_suku_cadang' => 40000000],   // Asahan (V)
        ['plat_nomor' => 'BK 9214 AF', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2019, 'kondisi' => 65, 'biaya_penanganan' => 8500000, 'nilai_jual' => 72500000, 'nilai_suku_cadang' => 42500000],   // Medan (A)
        ['plat_nomor' => 'BK 8583 LZ', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2020, 'kondisi' => 68, 'biaya_penanganan' => 9800000, 'nilai_jual' => 77000000, 'nilai_suku_cadang' => 45000000],  // Medan (L)
        ['plat_nomor' => 'BK 8920 HR', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2021, 'kondisi' => 71, 'biaya_penanganan' => 11100000, 'nilai_jual' => 81500000, 'nilai_suku_cadang' => 47500000], // Medan (H)
        ['plat_nomor' => 'BK 9156 NC', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2022, 'kondisi' => 74, 'biaya_penanganan' => 12400000, 'nilai_jual' => 86000000, 'nilai_suku_cadang' => 50000000], // Tebing Tinggi (N)
        ['plat_nomor' => 'BK 8301 EY', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2023, 'kondisi' => 77, 'biaya_penanganan' => 13700000, 'nilai_jual' => 90500000, 'nilai_suku_cadang' => 52500000],   // Medan (E)
        ['plat_nomor' => 'BK 8492 DG', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2014, 'kondisi' => 80, 'biaya_penanganan' => 15000000, 'nilai_jual' => 95000000, 'nilai_suku_cadang' => 55000000], // Medan (D)
        ['plat_nomor' => 'BK 9840 JU', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2015, 'kondisi' => 83, 'biaya_penanganan' => 16300000, 'nilai_jual' => 99500000, 'nilai_suku_cadang' => 57500000], // Labura (J)
        ['plat_nomor' => 'BK 8163 BX', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2016, 'kondisi' => 86, 'biaya_penanganan' => 17600000, 'nilai_jual' => 54000000, 'nilai_suku_cadang' => 30000000],   // Medan (B)
        ['plat_nomor' => 'BK 8925 SA', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2017, 'kondisi' => 89, 'biaya_penanganan' => 18900000, 'nilai_jual' => 58500000, 'nilai_suku_cadang' => 32500000], // Karo (S)
        ['plat_nomor' => 'BK 9038 ZP', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2018, 'kondisi' => 92, 'biaya_penanganan' => 2200000, 'nilai_jual' => 63000000, 'nilai_suku_cadang' => 35000000],  // Labusel (Z)
        ['plat_nomor' => 'BK 8671 FR', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2019, 'kondisi' => 95, 'biaya_penanganan' => 3500000, 'nilai_jual' => 67500000, 'nilai_suku_cadang' => 37500000],   // Medan (F)
        ['plat_nomor' => 'BK 8219 KW', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2020, 'kondisi' => 52, 'biaya_penanganan' => 4800000, 'nilai_jual' => 72000000, 'nilai_suku_cadang' => 40000000], // Medan (K)
        ['plat_nomor' => 'BK 9504 ME', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2021, 'kondisi' => 55, 'biaya_penanganan' => 6100000, 'nilai_jual' => 76500000, 'nilai_suku_cadang' => 42500000],   // Deli Serdang (M)
        ['plat_nomor' => 'BK 8342 UT', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2022, 'kondisi' => 58, 'biaya_penanganan' => 7400000, 'nilai_jual' => 81000000, 'nilai_suku_cadang' => 45000000],  // Simalungun (U)
        ['plat_nomor' => 'BK 8816 OY', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2023, 'kondisi' => 61, 'biaya_penanganan' => 8700000, 'nilai_jual' => 85500000, 'nilai_suku_cadang' => 47500000], // Batu Bara (O)
        ['plat_nomor' => 'BK 9427 PH', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2014, 'kondisi' => 64, 'biaya_penanganan' => 10000000, 'nilai_jual' => 90000000, 'nilai_suku_cadang' => 50000000],  // Langkat (P)
        ['plat_nomor' => 'BK 8093 VL', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2015, 'kondisi' => 67, 'biaya_penanganan' => 11300000, 'nilai_jual' => 94500000, 'nilai_suku_cadang' => 52500000],  // Asahan (V)
        ['plat_nomor' => 'BK 8365 GD', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2016, 'kondisi' => 70, 'biaya_penanganan' => 12600000, 'nilai_jual' => 99000000, 'nilai_suku_cadang' => 55000000], // Medan (G)
        ['plat_nomor' => 'BK 9182 CZ', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2017, 'kondisi' => 73, 'biaya_penanganan' => 13900000, 'nilai_jual' => 53500000, 'nilai_suku_cadang' => 57500000],   // Medan (C)
        ['plat_nomor' => 'BK 8540 RE', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2018, 'kondisi' => 76, 'biaya_penanganan' => 15200000, 'nilai_jual' => 58000000, 'nilai_suku_cadang' => 30000000],  // Binjai (R)
        ['plat_nomor' => 'BK 8609 YB', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2019, 'kondisi' => 79, 'biaya_penanganan' => 16500000, 'nilai_jual' => 62500000, 'nilai_suku_cadang' => 32500000], // Labuhanbatu (Y)
        ['plat_nomor' => 'BK 9731 WN', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2020, 'kondisi' => 82, 'biaya_penanganan' => 17800000, 'nilai_jual' => 67000000, 'nilai_suku_cadang' => 35000000],   // Pematangsiantar (W)
        ['plat_nomor' => 'BK 8254 TQ', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2021, 'kondisi' => 85, 'biaya_penanganan' => 19100000, 'nilai_jual' => 71500000, 'nilai_suku_cadang' => 37500000],  // Simalungun (T)
        ['plat_nomor' => 'BK 8180 FK', 'merk_tipe' => 'Colt Diesel', 'tahun' => 2022, 'kondisi' => 88, 'biaya_penanganan' => 2400000, 'nilai_jual' => 76000000, 'nilai_suku_cadang' => 40000000],  // Medan (F)
        ['plat_nomor' => 'BK 9623 AS', 'merk_tipe' => 'Toyota Dyna', 'tahun' => 2023, 'kondisi' => 91, 'biaya_penanganan' => 3700000, 'nilai_jual' => 80500000, 'nilai_suku_cadang' => 42500000],  // Medan (A)
        ['plat_nomor' => 'BK 8415 XL', 'merk_tipe' => 'Isuzu ELF', 'tahun' => 2014, 'kondisi' => 94, 'biaya_penanganan' => 5000000, 'nilai_jual' => 85000000, 'nilai_suku_cadang' => 45000000],   // Serdang Bedagai (X)
    ];

        foreach ($data as $item) {
            HistoriTruk::create($item);
        }
    }
}