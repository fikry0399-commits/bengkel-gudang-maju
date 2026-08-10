<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot'         => 'required|numeric',
            'jenis'         => 'required|in:benefit,cost',
        ]);

        Kriteria::create($request->all());

        return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan!');
    }

    public function destroy(string $id) // atau int $id
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->back()->with('success', 'Kriteria berhasil dihapus!');
    }
    public function edit(string $id)
{
    $kriteria = Kriteria::findOrFail($id);
    return view('admin.kriteria.edit', compact('kriteria'));
}

public function update(Request $request, string $id)
{
    $request->validate([
        'kode_kriteria' => 'required',
        'nama_kriteria' => 'required',
        'bobot'         => 'required|numeric',
        'jenis'         => 'required|in:benefit,cost',
    ]);

    $kriteria = Kriteria::findOrFail($id);
    $kriteria->update([
        'kode_kriteria' => $request->kode_kriteria,
        'nama_kriteria' => $request->nama_kriteria,
        'bobot'         => $request->bobot,
        'jenis'         => $request->jenis,
    ]);

    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
}
}