<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $programStudis = ProgramStudi::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('nama', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        $newId = $this->generateNewId();

        return view('prodi.program-studi', compact('programStudis', 'newId', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:program_studis,id',
            'nama' => 'required|string|max:255',
        ]);

        ProgramStudi::create([
            'id' => $validated['id'],
            'nama' => $validated['nama'],
        ]);

        return redirect()->route('program-studi.index')->with('success', 'Program Studi Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->update([
            'nama' => $validated['nama'],
        ]);

        return redirect()->route('program-studi.index')->with('success', 'Program Studi Berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->delete();

        return redirect()->route('program-studi.index')->with('success', 'Program Studi Berhasil Dihapus.');
    }

    private function generateNewId()
    {
        $lastProgramStudi = ProgramStudi::orderBy('id', 'desc')->first();
        $lastIdNumber = $lastProgramStudi ? (int) $lastProgramStudi->id : 0;
        $newIdNumber = $lastIdNumber + 1;
        $newId = str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);

        Log::info("Generated new ID: {$newId}");

        return $newId;
    }
}
