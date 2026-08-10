<?php

namespace App\Http\Controllers;

use App\Models\HistoriTruk;
use Illuminate\Http\Request;

class HistoriTrukController extends Controller
{
    public function index()
    {
        $histori = HistoriTruk::all();
        return view('admin.histori-truk.index', compact('histori'));
    }
}