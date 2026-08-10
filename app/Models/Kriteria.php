<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriterias';
    protected $primaryKey = 'id_kriteria'; // <-- Tambahkan baris ini!

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'jenis',
        'bobot',
    ];
}