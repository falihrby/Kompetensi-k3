<?php

namespace App\Http\Controllers;

use App\Models\KompetensiResult;
use App\Models\Peserta;
use App\Models\SoalKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KompetensiUmumController extends Controller
{
    public function index($questionNumber = 1)
    {
        $kategori = request()->query('kategori', 'umum');
        $questions = SoalKompetensi::where('kategori', $kategori)->get();
        $totalQuestions = $questions->count();

        if ($questionNumber < 1 || $questionNumber > $totalQuestions) {
            $questionNumber = 1;
        }

        return view('kompetensi-umum', compact('questions', 'questionNumber', 'totalQuestions', 'kategori'));
    }

    public function storeJawaban(Request $request)
    {
        Log::info('storeJawaban called', ['request' => $request->all()]);

        $validatedData = $request->validate([
            'question_number' => 'required|integer',
            'kategori' => 'required|string',
            'start_time' => 'required|date',
            'answers' => 'required|json',
            'jawaban' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $answers = json_decode($request->input('answers'), true);
            Log::info('Decoded answers', ['answers' => $answers]);

            $kategori = $request->input('kategori');
            $questions = SoalKompetensi::where('kategori', $kategori)->get();
            Log::info('Fetched questions', ['questions' => $questions]);

            $correctAnswers = 0;
            foreach ($questions as $question) {
                // Pastikan jawaban dari pengguna memiliki format yang sama dengan jawaban dari database
                $answer = $answers[$question->id] ?? null;
                Log::info('Checking answer', ['question_id' => $question->id, 'answer' => $answer, 'kunci_jawaban' => $question->kunci_jawaban]);

                // Normalisasi format jawaban jika perlu
                if (stripos($question->kunci_jawaban, 'Opsi') !== false && stripos($answer, 'Opsi') === false) {
                    $answer = 'Opsi ' . $answer;
                }

                // Ensure both values are strings for comparison
                if (strval($answer) === strval($question->kunci_jawaban)) {
                    $correctAnswers++;
                    Log::info('Correct answer', ['question_id' => $question->id]);
                }
            }

            $totalQuestions = $questions->count();
            $incorrectAnswers = $totalQuestions - $correctAnswers;
            $isPassed = $correctAnswers === $totalQuestions;

            // Get the participant data
            $peserta = Peserta::where('user_id', Auth::id())->firstOrFail();

            $kompetensiResult = KompetensiResult::create([
                'name' => $peserta->nama,
                'nomor' => $peserta->nomor,
                'program' => $peserta->program_studi,
                'fakultas' => $peserta->fakultas,
                'instansi' => $peserta->instansi,
                'kategori_ujian' => 'Kompetensi Umum',
                'keterangan' => $isPassed ? 'Lulus Ujian' : 'Tidak Lulus Ujian',
                'waktu_mulai_ujian' => session('start_time'),
                'waktu_selesai_ujian' => now(),
                'jumlah_soal_benar' => $correctAnswers,
                'jumlah_soal_salah' => $incorrectAnswers,
                'total_questions' => $totalQuestions,
            ]);

            DB::commit();

            $redirectUrl = route('kompetensi-umum.hasil');
            Log::info('Redirect URL', ['url' => $redirectUrl]);

            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan.',
                'data' => $kompetensiResult,
                'redirect_url' => route('kompetensi-umum.hasil'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing jawaban', ['error' => $e->getMessage(), 'input' => $request->all()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function hasilKompetensi()
    {
        Log::info('hasilKompetensi called');

        $user = Auth::user();
        $peserta = Peserta::where('user_id', $user->id)->firstOrFail();
        $answers = session()->get('answers', []);
        $startTime = session()->get('start_time');

        if (!$startTime) {
            Log::warning('No start time found, redirecting to index');
            return redirect()->route('kompetensi-umum.index');
        }

        $allQuestions = SoalKompetensi::where('kategori', 'umum')->get();
        $correctAnswers = 0;

        foreach ($allQuestions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->kunci_jawaban) {
                $correctAnswers++;
            }
        }

        $totalQuestions = $allQuestions->count();
        $incorrectAnswers = $totalQuestions - $correctAnswers;
        $isPassed = $correctAnswers === $totalQuestions;

        KompetensiResult::create([
            'name' => $peserta->nama,
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

        session()->forget(['answers', 'start_time']);

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

        Log::info('Returning hasil-kompetensi view', ['result' => $result]);

        return view('hasil-kompetensi', compact('result'));
    }

    public function retryKompetensi(Request $request)
    {
        session()->forget(['answers', 'start_time']);
        return redirect()->route('kompetensi-umum.index');
    }
}
