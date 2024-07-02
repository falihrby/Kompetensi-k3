<?php

namespace App\Http\Controllers;

use App\Models\KompetensiResult;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $kompetensiResults = KompetensiResult::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('nomor', 'LIKE', "%{$search}%")
                    ->orWhere('program', 'LIKE', "%{$search}%")
                    ->orWhere('fakultas', 'LIKE', "%{$search}%")
                    ->orWhere('instansi', 'LIKE', "%{$search}%")
                    ->orWhere('kategori_ujian', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%")
                    ->orWhere('waktu_mulai_ujian', 'LIKE', "%{$search}%")
                    ->orWhere('waktu_selesai_ujian', 'LIKE', "%{$search}%")
                    ->orWhere('user_id', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        return view('laporan.laporan', compact('kompetensiResults'));
    }

    public function cetakPeserta(Request $request)
    {
        $search = $request->input('search');
        $kompetensiResults = KompetensiResult::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('nomor', 'LIKE', "%{$search}%")
                    ->orWhere('program', 'LIKE', "%{$search}%")
                    ->orWhere('fakultas', 'LIKE', "%{$search}%")
                    ->orWhere('instansi', 'LIKE', "%{$search}%")
                    ->orWhere('kategori_ujian', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%")
                    ->orWhere('waktu_mulai_ujian', 'LIKE', "%{$search}%")
                    ->orWhere('waktu_selesai_ujian', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('laporan.cetak-laporan', compact('kompetensiResults'));
    }

    public function show($id)
    {
        $kompetensiResult = KompetensiResult::findOrFail($id);
        return view('laporan.detail', compact('kompetensiResult'));
    }
}
