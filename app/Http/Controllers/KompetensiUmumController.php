<?php

namespace App\Http\Controllers;

use App\Events\KompetensiResultCreated;
use App\Models\KompetensiResult;
use App\Models\SoalKompetensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KompetensiUmumController extends Controller
{
    public function index($questionNumber = 1)
    {
        $kategori = request()->query('kategori', 'umum');

        // Clear previous answers from session if this is a new attempt
        if (!session()->has('question_order')) {
            $questions = SoalKompetensi::where('kategori', $kategori)
                ->inRandomOrder()
                ->take(10)
                ->get();
            session(['question_order' => $questions->pluck('id')->toArray()]);
        }

        $questionOrder = session('question_order');
        $questions = SoalKompetensi::whereIn('id', $questionOrder)->get()->keyBy('id');
        $questions = collect($questionOrder)->map(fn($id) => $questions[$id]);

        $totalQuestions = $questions->count();

        if ($questionNumber < 1 || $questionNumber > $totalQuestions) {
            $questionNumber = 1;
        }

        if (!session()->has('start_time')) {
            session()->put('start_time', now());
        }

        return view('kompetensi-umum', compact('questions', 'questionNumber', 'totalQuestions', 'kategori'));
    }

    public function storeJawaban(Request $request)
    {
        Log::info('storeJawaban called', ['request' => $request->all()]);

        $validatedData = $request->validate([
            'kategori' => 'required|string',
            'start_time' => 'required|date',
            'answers' => 'required|json',
            'jawaban' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $answers = json_decode($request->input('answers'), true);
            Log::info('Decoded answers', ['answers' => $answers]);

            $questionOrder = session('question_order');
            $questions = SoalKompetensi::whereIn('id', $questionOrder)->get()->keyBy('id');

            $correctAnswers = 0;
            foreach ($questionOrder as $key => $questionId) {
                $question = $questions[$questionId];
                $answer = $answers[$key] ?? null;
                Log::info('Checking answer', ['question_id' => $question->id, 'answer' => $answer, 'kunci_jawaban' => $question->kunci_jawaban]);

                if (stripos($question->kunci_jawaban, 'Opsi') !== false && stripos($answer, 'Opsi') === false) {
                    $answer = 'Opsi ' . $answer;
                }

                if (strval($answer) === strval($question->kunci_jawaban)) {
                    $correctAnswers += 1;
                    Log::info('Correct answer', ['question_id' => $question->id]);
                }
            }

            $totalQuestions = count($questionOrder);
            $incorrectAnswers = $totalQuestions - $correctAnswers;
            $isPassed = $correctAnswers === $totalQuestions;

            $peserta = User::where('id', Auth::id())->firstOrFail();

            if (is_null($peserta->name)) {
                throw new \Exception("User 'name' field is null for user ID: " . Auth::id());
            }

            $lastExam = KompetensiResult::where('user_id', Auth::id())
                ->where('kategori_ujian', 'Kompetensi Umum')
                ->orderBy('ujian_ke_berapa', 'desc')
                ->first();

            $ujianKeBerapa = $lastExam ? $lastExam->ujian_ke_berapa + 1 : 1;

            $kompetensiResult = KompetensiResult::create([
                'name' => $peserta->name,
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
                'user_id' => Auth::id(),
                'ujian_ke_berapa' => $ujianKeBerapa,
            ]);

            // Trigger the event
            event(new KompetensiResultCreated($kompetensiResult));

            DB::commit();

            $redirectUrl = route('kompetensi-umum.hasil');
            Log::info('Redirect URL', ['url' => $redirectUrl]);
            session()->forget(['answers', 'start_time', 'question_order']);
            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan.',
                'data' => $kompetensiResult,
                'redirect_url' => $redirectUrl,
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
        $result = KompetensiResult::where('user_id', $user->id)->latest()->firstOrFail();

        if (!$result) {
            Log::warning('No start time found, redirecting to index');
            return redirect()->route('kompetensi-umum.index');
        }

        $isPassed = $result->keterangan;
        $totalQuestions = $result->total_questions;
        $correctAnswers = $result->jumlah_soal_benar;
        $incorrectAnswers = $result->jumlah_soal_salah;
        $startTime = $result->waktu_mulai_ujian;
        $endTime = $result->waktu_selesai_ujian;

        $result = [
            'isPassed' => $isPassed,
            'user' => $user,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'incorrectAnswers' => $incorrectAnswers,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];

        Log::info('Returning hasil-kompetensi view', ['result' => $result]);

        return view('hasil-kompetensi', compact('result'));
    }

    public function retryKompetensi(Request $request)
    {
        session()->forget(['question_order', 'answers', 'start_time']);
        return redirect()->route('dashboard');
    }
}
