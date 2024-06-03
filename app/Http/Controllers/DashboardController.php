<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $peserta = Peserta::where('user_id', Auth::id())->first();
        return view('dashboard', compact('peserta'));
    }
}
