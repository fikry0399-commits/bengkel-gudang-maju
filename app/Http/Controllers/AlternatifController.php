<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('admin.alternatif.index', compact('alternatifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required',
            'nama_alternatif' => 'required',
        ]);

        Alternatif::create([
            'kode_alternatif' => $request->kode_alternatif,
            'nama_alternatif' => $request->nama_alternatif,
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Data Alternatif berhasil ditambahkan!');
    }

    public function destroy(string $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Data Alternatif berhasil dihapus!');
    }
}