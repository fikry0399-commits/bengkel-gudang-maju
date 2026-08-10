<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    protected $primaryKey = 'id_alternatif';

    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
    ];
    public function penilaians()
    {
        return $this->hasMany(NilaiAlternatif::class, 'id_alternatif', 'id_alternatif');
    }

}
