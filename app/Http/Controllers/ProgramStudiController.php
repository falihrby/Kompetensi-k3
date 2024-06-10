<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        // Retrieve all program studies
        $programStudis = ProgramStudi::all();

        // Pass the data to the view
        return view('prodi.program-studi', compact('programStudis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        ProgramStudi::create($validated);

        return redirect()->route('prodi.program-studi')->with('success', 'Program Studi Berhasil Ditambahkan.');
    }
}
