<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\SoalKompetensi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function soalKompetensi()
    {
        return view('soal.soal-kompetensi');
    }

    public function laporan()
    {
        return view('laporan.laporan');
    }

    public function programStudi()
    {
        return view('prodi.program-studi');
    }

    public function fakultas()
    {
        return view('fakultas.fakultas');
    }

    public function instansi()
    {
        return view('instansi.instansi');
    }

    public function akunPeserta()
    {
        return view('akun.akun-peserta');
    }
}
