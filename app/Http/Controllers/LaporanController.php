<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporansExport;

class LaporanController extends Controller
{
    public function index(): View
    {
        $laporans = Laporan::all();
        return view('laporan.laporan', compact('laporans'));
    }

    public function show($id): View
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.detail', compact('laporan'));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporansExport, 'laporans.xlsx');
    }
}
