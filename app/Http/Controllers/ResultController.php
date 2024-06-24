<?php

namespace App\Http\Controllers;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show()
    {
        $peserta = Peserta::where('user_id', Auth::id())->first();
        return view('hasil-akhir', compact('peserta'));
    }
}
