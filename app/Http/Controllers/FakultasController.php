<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $fakultas = Fakultas::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('nama', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        $newId = $this->generateNewId();

        return view('fakultas.fakultas', compact('fakultas', 'newId', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:fakultas,id',
            'nama' => 'required|string|max:255',
        ]);

        Fakultas::create([
            'id' => $validated['id'],
            'nama' => $validated['nama'],
        ]);

        return redirect()->route('fakultas.index')->with('success', 'Fakultas Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update([
            'nama' => $validated['nama'],
        ]);

        return redirect()->route('fakultas.index')->with('success', 'Fakultas Berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('fakultas.index')->with('success', 'Fakultas Berhasil Dihapus.');
    }

    private function generateNewId()
    {
        $lastFakultas = Fakultas::orderBy('id', 'desc')->first();
        $lastIdNumber = $lastFakultas ? (int) $lastFakultas->id : 0;
        $newIdNumber = $lastIdNumber + 1;
        $newId = str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);

        return $newId;
    }
}
