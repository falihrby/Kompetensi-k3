<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show()
    {
        $peserta = User::where('id', Auth::id())->first();
        return view('hasil-akhir', compact('peserta'));
    }
}
