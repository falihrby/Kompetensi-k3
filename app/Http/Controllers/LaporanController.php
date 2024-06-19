<?php

namespace App\Http\Controllers;

use App\Models\KompetensiResult;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(): View
    {
        $kompetensiResults = KompetensiResult::paginate(15);
        return view('laporan.laporan', compact('kompetensiResults'));
    }

    public function cetakPeserta()
    {
        $kompetensiResults = KompetensiResult::get();
        return view('laporan.cetak-laporan', compact('kompetensiResults'));
    }

    public function show($id)
    {
        $kompetensiResult = KompetensiResult::findOrFail($id);
        return view('laporan.detail', compact('kompetensiResult'));
    }
}
