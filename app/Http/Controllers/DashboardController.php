<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kriteria;
use App\Models\Alternatif;

class DashboardController extends Controller
{
    public function index()
{
    $totalKriteria = DB::table('kriterias')->count();
    $totalAlternatif = DB::table('alternatifs')->count();

    $kriterias = Kriteria::all();
    
    // Ambil ID alternatif yang ada nilainya di database
    $selectedIds = DB::table('penilaians')->pluck('id_alternatif')->unique()->toArray();
    $alternatifs = Alternatif::whereIn('id_alternatif', $selectedIds)->get();
    
    $topRank = null;
    $scores = [];

    if ($alternatifs->isNotEmpty() && $kriterias->isNotEmpty()) {
        $penilaians = DB::table('penilaians')->get();

        foreach ($alternatifs as $alt) {
            $idAlt = $alt->id_alternatif;
            $vPasar = 0;
            $tipeTruk = $alt->nama_alternatif;

            // 1. Ambil Benchmark Pasar
            $benchmark = DB::table('harga_pasar_truk')->where('nama_tipe_truk', $tipeTruk)->first();
if (!$benchmark) {
    $kataDepan = explode(' ', $tipeTruk)[0] ?? '';
    $benchmark = DB::table('harga_pasar_truk')->where('nama_tipe_truk', 'LIKE', $kataDepan . '%')->first();
}

            $maxKondisi   = $benchmark->max_kondisi_fisik ?? 100;
            $minBiaya     = $benchmark->min_biaya_penanganan ?? 3000000;
            $maxNilaiJual = $benchmark->max_nilai_jual ?? 95000000;
            $maxSukuCadang= $benchmark->max_nilai_sparepart ?? 45000000;

            // 2. Hitung Normalisasi Benchmark Pasar
            foreach ($kriterias as $k) {
                $idKrit = $k->id_kriteria;
                $row = $penilaians->where('id_alternatif', $idAlt)->where('id_kriteria', $idKrit)->first();
                $rawVal = $row->nilai ?? 0;
                $x = (float) preg_replace('/[^0-9.]/', '', $rawVal);
                $namaKriteria = strtolower($k->nama_kriteria ?? '');

                $r = 0;
                if (str_contains($namaKriteria, 'kondisi')) {
                    $r = ($maxKondisi > 0) ? ($x / $maxKondisi) : 0;
                } elseif (str_contains($namaKriteria, 'biaya')) {
                    $r = ($x > 0) ? ($minBiaya / $x) : 0;
                } elseif (str_contains($namaKriteria, 'jual')) {
                    $r = ($maxNilaiJual > 0) ? ($x / $maxNilaiJual) : 0;
                } else {
                    $r = ($maxSukuCadang > 0) ? ($x / $maxSukuCadang) : 0;
                }

                $r = min((float)$r, 1.0);
                $bobot = (float)($k->bobot > 1 ? $k->bobot / 100 : $k->bobot);

                $vPasar += ($r * $bobot);
            }

            $scores[$idAlt] = $vPasar;
        }

        if (!empty($scores)) {
            arsort($scores);
            $topId = array_key_first($scores);
            $topRank = $alternatifs->where('id_alternatif', $topId)->first();
        }
    }

    return view('admin.index', compact('totalKriteria', 'totalAlternatif', 'topRank', 'scores', 'alternatifs'));
}
}