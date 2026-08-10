<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriTruk extends Model
{
    use HasFactory;

    protected $table = 'histori_truks'; // Nama tabel kamu

    // Izinkan semua kolom agar bisa diisi secara mass assignment
    protected $guarded = []; 

    // ATAU jika ingin mendefinisikan kolom spesifik, gunakan $fillable:
    /*
    protected $fillable = [
        'plat_nomor',
        'merk_tipe',
        'tahun',
        'penjual',
        'kondisi',
        'biaya_penanganan',
        'nilai_jual',
        'nilai_suku_cadang',
    ];
    */
}