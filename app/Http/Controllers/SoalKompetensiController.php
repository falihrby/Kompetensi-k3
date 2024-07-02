<?php

namespace App\Http\Controllers;

use App\Models\SoalKompetensi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SoalKompetensiController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $soalKompetensis = SoalKompetensi::query()
            ->when($search, function ($query, $search) {
                return $query->where('pertanyaan', 'LIKE', "%{$search}%")
                    ->orWhere('kategori', 'LIKE', "%{$search}%")
                    ->orWhere('opsi_a', 'LIKE', "%{$search}%")
                    ->orWhere('opsi_b', 'LIKE', "%{$search}%")
                    ->orWhere('opsi_c', 'LIKE', "%{$search}%")
                    ->orWhere('opsi_d', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('kunci_jawaban', 'LIKE', "%{$search}%");
            })
            ->paginate(15);

        return view('soal.soal-kompetensi', ['soalKompetensis' => $soalKompetensis]);
    }

    public function create(): View
    {
        $defaultId = str_pad(SoalKompetensi::max('id') + 1, 4, '0', STR_PAD_LEFT);
        return view('soal.create', ['defaultId' => $defaultId]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'kunci_jawaban' => 'required|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $soal = new SoalKompetensi($validated);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images', 'public');
            $soal->gambar = $path;
        }

        $soal->save();

        return redirect()->route('soal-kompetensi.index')->with('success', 'Soal Kompetensi Berhasil Disimpan.');
    }

    public function show(string $id): View
    {
        $soalKompetensi = SoalKompetensi::findOrFail($id);
        return view('soal.show', ['soalKompetensi' => $soalKompetensi]);
    }

    public function edit(string $id): View
    {
        $soalKompetensi = SoalKompetensi::findOrFail($id);
        return view('soal.edit', ['soalKompetensi' => $soalKompetensi]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'kunci_jawaban' => 'required|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $soal = SoalKompetensi::findOrFail($id);
        $soal->fill($validated);

        if ($request->hasFile('gambar')) {
            if ($soal->gambar) {
                Storage::disk('public')->delete($soal->gambar);
            }
            $path = $request->file('gambar')->store('images', 'public');
            $soal->gambar = $path;
        }

        $soal->save();

        return redirect()->route('soal-kompetensi.index')->with('success', 'Soal Kompetensi Berhasil Diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $soalKompetensi = SoalKompetensi::findOrFail($id);

        if ($soalKompetensi->gambar) {
            Storage::disk('public')->delete($soalKompetensi->gambar);
        }

        $soalKompetensi->delete();

        return redirect()->route('soal-kompetensi.index')->with('flash_message', 'Soal Kompetensi Berhasil Dihapus!');
    }

    public function kompetensiUmum(Request $request): View
    {
        $questions = SoalKompetensi::where('kategori', 'umum')->get();
        $questionNumber = 1; // Initialize question number
        $totalQuestions = $questions->count();

        return view('kompetensi-umum', [
            'kategori' => 'umum',
            'questions' => $questions,
            'questionNumber' => $questionNumber,
            'totalQuestions' => $totalQuestions,
        ]);
    }

    public function storeJawaban(Request $request): RedirectResponse
    {
        $answers = json_decode($request->input('jawaban'), true);
        $kategori = $request->input('kategori');

        return redirect()->route('kompetensi-umum.hasil');
    }
}
