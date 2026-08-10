<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiAlternatif;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\HistoriTruk;
use App\Models\HargaPasarTruk;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        $ids = $alternatifs->pluck('id_alternatif')->toArray();
        $penilaians = NilaiAlternatif::query()
            ->whereIn('id_alternatif', $ids)
            ->get()
            ->groupBy('id_alternatif');

        return view('admin.penilaian.index', compact('alternatifs', 'kriterias', 'penilaians'));
    }

    public function hitung(Request $request)
    {
        // 1. Simpan/Update saat Form Submit (POST)
        if ($request->isMethod('post')) {
            $request->validate([
                'nilai' => 'required|array',
            ]);

            $selectedIds = $request->input('selected_alternatif', []);
            $platNomorInput = $request->input('plat_nomor', []); // <-- TAMBAH INI
            $tahunInput     = $request->input('tahun', []);      // <-- TAMBAH INI

            if (empty($selectedIds)) {
                return redirect()->back()->with('error', 'Pilih minimal satu truk yang ingin dinilai!');
            }

            // Hapus data penilaian lama yang tidak dicentang
            NilaiAlternatif::whereNotIn('id_alternatif', $selectedIds)->delete();

            $nilaiInput = $request->input('nilai', []);
            $kriterias = Kriteria::all();

            foreach ($selectedIds as $id_alternatif) {
                $alternatif = Alternatif::find($id_alternatif);
                $kriteriasInput = $nilaiInput[$id_alternatif] ?? [];

                // Simpan ke tabel penilaians (SAW)
                foreach ($kriteriasInput as $idKriteria => $nilai) {
                    NilaiAlternatif::updateOrCreate(
                        [
                            'id_alternatif' => $id_alternatif,
                            'id_kriteria'   => $idKriteria,
                        ],
                        [
                            'nilai' => $nilai
                        ]
                    );
                }

                // Otomatis Simpan ke Histori Truk
                $valKondisi = 0;
                $valBiaya = 0;
                $valNilaiJual = 0;
                $valSukuCadang = 0;

                foreach ($kriterias as $k) {
                    $val = $kriteriasInput[$k->id_kriteria] ?? 0;
                    $namaKriteria = strtolower($k->nama_kriteria ?? '');

                    if (str_contains($namaKriteria, 'kondisi')) {
                        $valKondisi = $val;
                    } elseif (str_contains($namaKriteria, 'biaya')) {
                        $valBiaya = $val;
                    } elseif (str_contains($namaKriteria, 'jual')) {
                        $valNilaiJual = $val;
                    } else {
                        $valSukuCadang = $val;
                    }
                }

                if ($alternatif) {
                    // Ambil plat nomor & tahun dari form input
                    $platNomor = $platNomorInput[$id_alternatif] ?? $alternatif->plat_nomor ?? '-';
                    $tahun     = $tahunInput[$id_alternatif]     ?? $alternatif->tahun      ?? date('Y');

                    HistoriTruk::create([
                        'plat_nomor'        => strtoupper($platNomor),
                        'merk_tipe'         => $alternatif->nama_alternatif ?? '-',
                        'tahun'             => $tahun,
                        'kondisi'           => $valKondisi,
                        'biaya_penanganan'  => $valBiaya,
                        'nilai_jual'        => $valNilaiJual,
                        'nilai_suku_cadang' => $valSukuCadang,
                    ]);
                }
            }
        }

        // 2. Ambil data tersimpan (GET & POST)
        $selectedIds = NilaiAlternatif::pluck('id_alternatif')->unique()->toArray();

        if (empty($selectedIds)) {
            return redirect()->route('penilaian.index')->with('error', 'Silakan lakukan penilaian terlebih dahulu!');
        }

        $alternatifs = Alternatif::whereIn('id_alternatif', $selectedIds)->get();
        $kriterias = Kriteria::all();
        $penilaians = NilaiAlternatif::whereIn('id_alternatif', $selectedIds)->get();

        $matriksX = [];
        foreach ($penilaians as $p) {
            $matriksX[$p->id_alternatif][$p->id_kriteria] = $p->nilai;
        }

        // TAHAP 1 & 2: Benchmark Pasar
        $hasilTahap2 = [];
        $matriksR_Pasar = [];

        foreach ($alternatifs as $alt) {
            $vPasar = 0;
            $tipeTruk = $alt->nama_alternatif;

            $benchmark = HargaPasarTruk::where('nama_tipe_truk', $tipeTruk)->first();
            if (!$benchmark) {
                $parts = explode(' ', $tipeTruk, 2);
                $kataDepan = $parts[0] ?? '';
                $benchmark = HargaPasarTruk::where('nama_tipe_truk', 'LIKE', $kataDepan . '%')->first();
            }

            $maxKondisi   = $benchmark->max_kondisi_fisik ?? 100;
            $minBiaya     = $benchmark->min_biaya_penanganan ?? 3000000;
            $maxNilaiJual = $benchmark->max_nilai_jual ?? 95000000;
            $maxSukuCadang= $benchmark->max_nilai_sparepart ?? 45000000;

            foreach ($kriterias as $k) {
                $rawVal = $matriksX[$alt->id_alternatif][$k->id_kriteria] ?? 0;
                $x = (float) preg_replace('/[^0-9.]/', '', $rawVal);
                $namaKriteria = strtolower($k->nama_kriteria ?? '');

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
                $matriksR_Pasar[$alt->id_alternatif][$k->id_kriteria] = $r;

                $bobot = (float)($k->bobot > 1 ? $k->bobot / 100 : $k->bobot);
                $vPasar += ($r * $bobot);
            }

            if ($vPasar > 0.75) {
                $rekomendasi = 'Dijual Langsung';
            } elseif ($vPasar > 0.45) {
                $rekomendasi = 'Diperbaiki Sebelum Dijual';
            } else {
                $rekomendasi = 'Dibongkar untuk Suku Cadang';
            }

            $hasilTahap2[$alt->id_alternatif] = [
                'skor_pasar'  => $vPasar,
                'rekomendasi' => $rekomendasi
            ];
        }

        // TAHAP 3: Perbandingan & Perangkingan SAW
        $matriksR_SAW = [];
        $hasilTahap3 = [];

        foreach ($alternatifs as $alt) {
            $vSAW = 0;
            foreach ($kriterias as $k) {
                $r = $matriksR_Pasar[$alt->id_alternatif][$k->id_kriteria] ?? 0;
                $matriksR_SAW[$alt->id_alternatif][$k->id_kriteria] = $r;

                $bobot = (float)($k->bobot > 1 ? $k->bobot / 100 : $k->bobot);
                $vSAW += ($r * $bobot);
            }

            $hasilTahap3[] = [
                'alternatif' => $alt,
                'nilai_v'    => $vSAW,
                'skor_pasar' => $hasilTahap2[$alt->id_alternatif]['skor_pasar'] ?? 0,
                'strategi'   => $hasilTahap2[$alt->id_alternatif]['rekomendasi'] ?? '-'
            ];
        }

        usort($hasilTahap3, function ($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        return view('admin.penilaian.hasil', compact(
            'alternatifs',
            'kriterias',
            'matriksX',
            'matriksR_SAW',
            'hasilTahap2',
            'hasilTahap3'
        ) + ['hasilV' => $hasilTahap3]);
    }
}