<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\ProgramStudi;
use App\Models\Fakultas;
use App\Models\Instansi;
use App\Models\User;
use App\Models\SoalKompetensi;
use App\Models\Kelulusan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $peserta = User::where('id', Auth::id())->first();
        return view('dashboard', compact('peserta'));
    }

    public function cetakSertifikat()
    {
        $peserta = User::where('id', Auth::id())->first();
        return view('sertifikat-peserta', compact('peserta'));
    }

    public function adminIndex()
    {
        $jumlahPesertaUjian = User::where('usertype', 'user')->count();
        $jumlahProgramStudi = ProgramStudi::count();
        $jumlahFakultas = Fakultas::count();
        $jumlahInstansi = Instansi::count();
        $jumlahInstansi = Instansi::count();
        $jumlahSoal = SoalKompetensi::count();
        $jumlahPesertaLulus = Kelulusan::count();

        return view('admin.dashboard', compact('jumlahPesertaUjian', 'jumlahProgramStudi', 'jumlahFakultas', 'jumlahInstansi', 'jumlahSoal', 'jumlahPesertaLulus'));
    }
}
