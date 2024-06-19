<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Instansi;
use App\Models\KategoriUjian;
use App\Models\Peserta;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AkunPesertaController extends Controller
{
    public function index(Request $request): View
    {
        $akunPeserta = Peserta::paginate(15);
        return view('akun.akun-peserta', ['akunPeserta' => $akunPeserta]);
    }

    public function create()
    {
        $nextUserId = str_pad(User::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $programStudis = ProgramStudi::all();
        $fakultases = Fakultas::all();
        $instansis = Instansi::all();

        return view('akun.create', compact('nextUserId', 'programStudis', 'fakultases', 'instansis'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called');

        // Debug the request data
        Log::info('Request data:', $request->all());

        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nomor' => 'required|string|max:255',
            'program_studis' => 'required|integer|exists:program_studi,id',
            'fakultas' => 'required|integer|exists:fakultas,id',
            'instansi' => 'required|integer|exists:instansi,id',
            'kategori_ujian_pilihan' => 'required|array',
            'kategori_ujian_pilihan.*' => 'required|string|max:255',
        ]);

        Log::info('Validation passed');

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Log the created user
        Log::info('Created user:', $user->toArray());

        // Create the peserta
        $peserta = Peserta::create([
            'user_id' => $user->id,
            'nomor' => $validatedData['nomor'],
            'program_studi_id' => $validatedData['program_studi'],
            'fakultas_id' => $validatedData['fakultas'],
            'instansi_id' => $validatedData['instansi'],
        ]);

        // Log the created peserta
        Log::info('Created peserta:', $peserta->toArray());

        // Create kategori ujian for the peserta
        foreach ($validatedData['kategori_ujian_pilihan'] as $kategori) {
            KategoriUjian::create([
                'user_id' => $user->id,
                'kategori' => $kategori,
            ]);
        }

        Log::info('All data created successfully');

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta berhasil ditambahkan.');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'nomor' => 'required|string|max:255',
            'program_studis' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'kategori_ujian_wajib' => 'required|string|max:255',
        ]);

        $akunPeserta = Peserta::findOrFail($id);
        $user = User::findOrFail($akunPeserta->user_id);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        $akunPeserta->update([
            'nomor' => $validatedData['nomor'],
            'program_studi_id' => $validatedData['program_studi'],
            'fakultas_id' => $validatedData['fakultas'],
            'instansi_id' => $validatedData['instansi'],
        ]);

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta updated successfully.');
    }

    public function destroy($id)
    {
        $akunPeserta = Peserta::findOrFail($id);
        $user = User::findOrFail($akunPeserta->user_id);

        $akunPeserta->delete();
        $user->delete();

        return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta deleted successfully.');
    }
}
