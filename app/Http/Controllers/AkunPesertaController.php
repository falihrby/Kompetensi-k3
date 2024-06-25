<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Instansi;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AkunPesertaController extends Controller
{
    public function index(Request $request): View
    {
        $akunPeserta = User::where('usertype', 'user')->paginate(15);
        return view('akun.akun-peserta', ['akunPeserta' => $akunPeserta]);
    }

    public function create(): View
    {
        $nextUserId = str_pad(User::max('id') + 1, 4, '0', STR_PAD_LEFT);
        $programStudis = ProgramStudi::all();
        $fakultases = Fakultas::all();
        $instansis = Instansi::all();

        return view('akun.create', compact('nextUserId', 'programStudis', 'fakultases', 'instansis'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        DB::beginTransaction();
        try {
            $user = $this->createUser($validatedData);

            DB::commit();

            Log::info('User created successfully', ['user_id' => $user->id]);

            return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'validated_data' => $validatedData,
            ]);

            return back()->withErrors(['message' => 'There was an error creating the user: ' . $e->getMessage()])->withInput();
        }
    }

    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'nomor' => 'required|string|max:255',
            'program_studi' => 'required|exists:program_studis,nama',
            'fakultas' => 'required|exists:fakultas,nama',
            'instansi' => 'required|exists:instansi,name',
        ]);

        Log::info('Validation passed', $validated);
        return $validated;
    }

    private function createUser(array $validatedData): User
    {
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'nomor' => $validatedData['nomor'],
            'program_studi' => $validatedData['program_studi'],
            'fakultas' => $validatedData['fakultas'],
            'instansi' => $validatedData['instansi'],
            'usertype' => 'user',
        ]);

        Log::info('Created user', $user->toArray());

        return $user;
    }

    public function show($id): View
    {
        $akunPeserta = User::findOrFail($id);
        return view('akun.show', compact('akunPeserta'));
    }

    public function edit($id): View
    {
        $akunPeserta = User::findOrFail($id);
        $programStudis = ProgramStudi::all();
        $fakultases = Fakultas::all();
        $instansis = Instansi::all();

        return view('akun.edit', compact('akunPeserta', 'programStudis', 'fakultases', 'instansis'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateUpdateRequest($request, $id);

        $akunPeserta = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $this->updateUser($akunPeserta, $validatedData);

            DB::commit();

            Log::info('Updated user', ['user_id' => $akunPeserta->id]);

            return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'validated_data' => $validatedData,
            ]);
            return back()->withErrors(['message' => 'There was an error updating the user.'])->withInput();
        }
    }

    private function validateUpdateRequest(Request $request, $id): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'nomor' => 'required|string|max:255',
            'program_studi' => 'required|exists:program_studis,nama',
            'fakultas' => 'required|exists:fakultas,nama',
            'instansi' => 'required|exists:instansi,name',
        ]);

        Log::info('Validation passed', $validated);
        return $validated;
    }

    private function updateUser(User $user, array $validatedData)
    {
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nomor' => $validatedData['nomor'],
            'program_studi' => $validatedData['program_studi'],
            'fakultas' => $validatedData['fakultas'],
            'instansi' => $validatedData['instansi'],
        ]);

        if (!empty($validatedData['password'])) {
            $user->update([
                'password' => Hash::make($validatedData['password']),
            ]);
        }

        Log::info('Updated user', $user->toArray());
    }

    public function destroy($id)
    {
        $akunPeserta = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $akunPeserta->delete();

            DB::commit();

            Log::info('Deleted user', ['user_id' => $id]);

            return redirect()->route('akun-peserta.index')->with('success', 'Akun Peserta deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $id,
            ]);
            return back()->withErrors(['message' => 'There was an error deleting the user.']);
        }
    }
}
