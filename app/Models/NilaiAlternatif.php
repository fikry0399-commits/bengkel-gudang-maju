<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    use HasFactory;

    protected $table = 'penilaians';
    protected $primaryKey = 'id_penilaian';
    public $incrementing = true;
    protected $fillable = [
        'id_truk',
        'id_alternatif',
        'id_kriteria',
        'nilai',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
    //
}
