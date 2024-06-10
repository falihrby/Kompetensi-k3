<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\ProgramStudiController;

class AkunPesertaController extends Controller
{
    public function index(Request $request): View
    {
        $akunPeserta = Peserta::all();
        return view('akun.akun-peserta', ['akunPeserta' => $akunPeserta]);
    }

    public function create()
    {
        $nextUserId = str_pad(Peserta::max('user_id') + 1, 4, '0', STR_PAD_LEFT);
        $programStudis = ProgramStudi::all();
        $fakultases = Fakultas::all();
        $instansis = Instansi::all();

        return view('akun-peserta.create', compact('nextUserId', 'programStudis', 'fakultases', 'instansis'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pesertas,email',
            'password' => 'required|string|max:255',
            'kategori_ujian_wajib' => 'required|string|max:255',
        ]);

        // Store password as plain text
        Peserta::create($validatedData);

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta created successfully.');
    }

    public function show($id): View
    {
        $akunPeserta = Peserta::findOrFail($id);
        return view('akun.show', compact('akunPeserta'));
    }

    public function edit($id): View
    {
        $akunPeserta = Peserta::findOrFail($id);
        return view('akun.edit', compact('akunPeserta'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pesertas,email,' . $id,
            'password' => 'nullable|string|max:255',
            'kategori_ujian_wajib' => 'required|string|max:255',
        ]);

        if ($request->filled('password')) {
            // Store password as plain text
            $validatedData['password'] = $request->password;
        } else {
            unset($validatedData['password']);
        }

        $akunPeserta = Peserta::findOrFail($id);
        $akunPeserta->update($validatedData);

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta updated successfully.');
    }

    public function destroy($id)
    {
        $akunPeserta = Peserta::findOrFail($id);
        $akunPeserta->delete();

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta deleted successfully.');
    }
}
