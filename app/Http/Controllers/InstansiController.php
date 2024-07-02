<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $instansis = Instansi::query()
            ->when($search, function ($query, $search) {
                return $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        $newId = $this->generateNewId();

        return view('instansi.instansi', compact('instansis', 'newId', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:instansi,id',
            'name' => 'required|string|max:255',
        ]);

        Instansi::create([
            'id' => $validated['id'],
            'name' => $validated['name'],
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi Berhasil Ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi Berhasil Diperbarui.');
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi Berhasil Dihapus.');
    }

    private function generateNewId()
    {
        $lastInstansi = Instansi::orderBy('id', 'desc')->first();
        $lastIdNumber = $lastInstansi ? (int) $lastInstansi->id : 0;
        $newIdNumber = $lastIdNumber + 1;
        $newId = str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);

        return $newId;
    }
}
