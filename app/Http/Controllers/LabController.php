<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    public function index($labName = null)
    {
        $peserta = User::where('id', Auth::id())->first();
        return view('khusus-dashboard', compact('peserta', 'labName'));
    }

    public function show()
    {
        return view('pilih-lab');
    }

}
