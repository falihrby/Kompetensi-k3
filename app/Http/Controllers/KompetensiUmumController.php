<?php

namespace App\Http\Controllers;

use App\Models\KompetensiResult;
use App\Models\Peserta;
use Illuminate\Support\Facades\Log;
use App\Models\SoalKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KompetensiUmumController extends Controller
{
    public function index($questionNumber = 1)
    {
        $kategori = request()->query('kategori', 'umum'); // Assuming 'umum' is the default category
        $questions = SoalKompetensi::where('kategori', $kategori)->get();
        $totalQuestions = $questions->count();

        if ($questionNumber < 1 || $questionNumber > $totalQuestions) {
            $questionNumber = 1;
        }

        return view('kompetensi-umum', compact('questions', 'questionNumber', 'totalQuestions', 'kategori'));
    }

    public function fetchQuestions($kategori)
    {
        $questions = SoalKompetensi::where('kategori', $kategori)->get();
        return response()->json($questions);
    }

    public function storeJawaban(Request $request)
    {
        $request->validate([
            'answers' => 'required',
            'start_time' => 'required|date',
        ]);

        try {
            $answers = json_decode($request->input('answers'), true);
            session(['answers' => $answers, 'start_time' => $request->input('start_time')]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error storing jawaban: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function hasilKompetensi()
    {
        $user = Auth::user();
        $peserta = Peserta::where('user_id', $user->id)->firstOrFail();
        $answers = session()->get('answers', []);
        $startTime = session()->get('start_time');

        $questions = SoalKompetensi::whereIn('id', array_keys($answers))->get();
        $correctAnswers = 0;

        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->kunci_jawaban) {
                $correctAnswers++;
            }
        }

        $totalQuestions = count($questions);
        $incorrectAnswers = $totalQuestions - $correctAnswers;
        $isPassed = $correctAnswers === $totalQuestions;

        try {
            KompetensiResult::create([
                'name' => $user->name,
                'nomor' => $peserta->nomor,
                'program' => $peserta->program_studi,
                'fakultas' => $peserta->fakultas,
                'instansi' => $peserta->instansi,
                'kategori_ujian' => 'Kompetensi Umum',
                'keterangan' => $isPassed ? 'Lulus Ujian' : 'Tidak Lulus Ujian',
                'waktu_mulai_ujian' => $startTime,
                'waktu_selesai_ujian' => now(),
                'jumlah_soal_benar' => $correctAnswers,
                'jumlah_soal_salah' => $incorrectAnswers,
                'total_questions' => $totalQuestions,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $result = [
            'isPassed' => $isPassed,
            'user' => $user,
            'peserta' => $peserta,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'incorrectAnswers' => $incorrectAnswers,
            'startTime' => $startTime,
            'endTime' => now(),
        ];

        return view('hasil-kompetensi', compact('result'));
    }

}
