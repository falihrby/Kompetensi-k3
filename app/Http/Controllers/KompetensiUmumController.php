<?php

namespace App\Http\Controllers;

use App\Models\SoalKompetensi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KompetensiUmumController extends Controller
{
    public function index(Request $request): View
    {
        $questions = SoalKompetensi::all();
        $questionNumber = $request->query('questionNumber', 1);
        $totalQuestions = $questions->count();
        $kategori = 'Kompetensi Umum'; 

        return view('kompetensi-umum', compact('questions', 'questionNumber', 'totalQuestions', 'kategori'));
    }

    public function storeJawaban(Request $request)
    {
        // Logic to store the answer
        return redirect()->route('kompetensi-umum.index', ['questionNumber' => $request->input('question_number') + 1]);
    }
}
