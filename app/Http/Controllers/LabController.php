<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    public function index($labName = null)
    {
        $peserta = Peserta::where('user_id', Auth::id())->first();
        return view('khusus-dashboard', compact('peserta', 'labName'));
    }

    public function show()
    {
        return view('pilih-lab');
    }

}
