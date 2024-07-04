<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKelulusanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelulusanData = Kelulusan::where('nama', 'like', "%$search%")
            ->orWhere('nomor', 'like', "%$search%")
            ->paginate(10);

        return view('laporan.kelulusan.data-kelulusan', compact('kelulusanData'));
    }

    public function cetakKelulusan(Request $request)
    {
        $search = $request->input('search');
        $kelulusanData = Kelulusan::where('nama', 'like', "%$search%")
            ->orWhere('nomor', 'like', "%$search%")
            ->get();

        return view('laporan.kelulusan.cetak-kelulusan', compact('kelulusanData'));
    }

    public function show($id)
    {
        $kelulusan = Kelulusan::findOrFail($id);
        return view('laporan.kelulusan.detail-kelulusan', compact('kelulusan'));
    }

    public function sertifikatKelulusan($nama)
    {
        $kelulusan = Kelulusan::where('nama', $nama)->firstOrFail();
        return view('laporan.kelulusan.sertifikat-kelulusan', compact('kelulusan'));
    }
}
