<?php

namespace App\Http\Controllers;

use App\Models\KompetensiResult;
use App\Models\SoalKompetensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KompetensiKhususController extends Controller
{
    public function index($labName = null)
    {
        Log::info('Fetching questions for lab:', ['labName' => $labName]);

        if (!str_starts_with($labName, 'Khusus ')) {
            $labName = 'Khusus ' . $labName;
        }

        Log::info('Updated labName:', ['labName' => $labName]);

        // Check if session data for question order exists
        if (!session()->has('question_order')) {
            $questions = SoalKompetensi::where('kategori', $labName)
                ->inRandomOrder()
                ->take(10)
                ->get();

            session(['question_order' => $questions->pluck('id')->toArray()]);
        }

        $questionOrder = session('question_order');
        $questions = SoalKompetensi::whereIn('id', $questionOrder)->get()->keyBy('id');
        $questions = collect($questionOrder)->map(fn($id) => $questions[$id]);

        $totalQuestions = $questions->count();

        Log::info('Number of questions fetched:', ['totalQuestions' => $totalQuestions, 'questions' => $questions]);

        if ($questions->isEmpty()) {
            Log::warning('No questions found for the specified lab:', ['labName' => $labName]);
        } else {
            Log::info('Questions fetched:', ['questions' => $questions->toArray()]);
        }

        if (!session()->has('start_time')) {
            session()->put('start_time', now());
        }

        // Load the saved answers from the session
        $savedAnswers = session('answers', []);

        return view('kompetensi-khusus', compact('questions', 'totalQuestions', 'labName', 'savedAnswers'));
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

            $kategori = $request->input('kategori');
            if (!str_starts_with($kategori, 'Khusus ')) {
                $kategori = 'Khusus ' . $kategori;
            }

            // Save the answers in the session
            session(['answers' => $answers]);

            $questionOrder = session('question_order');
            $questions = SoalKompetensi::whereIn('id', $questionOrder)->get()->keyBy('id');
            $questions = collect($questionOrder)->map(fn($id) => $questions[$id]);

            Log::info('Fetched questions', ['questions' => $questions]);

            $correctAnswers = 0;
            foreach ($questions as $key => $question) {
                $answer = $answers[$key] ?? null;

                Log::info('Checking answer', ['question_id' => $question->id, 'answer' => $answer, 'kunci_jawaban' => $question->kunci_jawaban]);

                if (strval($answer) === strval($question->kunci_jawaban)) {
                    $correctAnswers += 1;
                    Log::info('Correct answer', ['question_id' => $question->id]);
                }
            }

            $totalQuestions = $questions->count();
            $incorrectAnswers = $totalQuestions - $correctAnswers;
            $isPassed = $correctAnswers === $totalQuestions;

            $peserta = User::where('id', Auth::id())->firstOrFail();

            $lastExam = KompetensiResult::where('user_id', Auth::id())
                ->where('kategori_ujian', $kategori)
                ->orderBy('ujian_ke_berapa', 'desc')
                ->first();

            $ujianKeBerapa = $lastExam ? $lastExam->ujian_ke_berapa + 1 : 1;

            $kompetensiResult = KompetensiResult::create([
                'name' => $peserta->name,
                'nomor' => $peserta->nomor,
                'program' => $peserta->program_studi,
                'fakultas' => $peserta->fakultas,
                'instansi' => $peserta->instansi,
                'kategori_ujian' => $kategori,
                'keterangan' => $isPassed ? 'Lulus Ujian' : 'Tidak Lulus Ujian',
                'waktu_mulai_ujian' => session('start_time'),
                'waktu_selesai_ujian' => now(),
                'jumlah_soal_benar' => $correctAnswers,
                'jumlah_soal_salah' => $incorrectAnswers,
                'total_questions' => $totalQuestions,
                'user_id' => Auth::id(),
                'ujian_ke_berapa' => $ujianKeBerapa,
            ]);

            DB::commit();

            session()->forget(['answers', 'start_time', 'question_order']);

            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan.',
                'data' => $kompetensiResult,
                'redirect_url' => route('kompetensi-khusus.hasil'),
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
        $peserta = User::where('id', $user->id)->firstOrFail();
        $result = KompetensiResult::where('user_id', $user->id)->latest()->firstOrFail();

        if (!$result) {
            Log::warning('No start time found, redirecting to index');
            return redirect()->route('kompetensi-khusus.index');
        }

        $isPassed = $result->keterangan;
        $totalQuestions = $result->total_questions;
        $correctAnswers = $result->jumlah_soal_benar;
        $incorrectAnswers = $result->jumlah_soal_salah;
        $startTime = $result->waktu_mulai_ujian;
        $endTime = $result->waktu_selesai_ujian;

        $labName = $result->kategori_ujian;

        $result = [
            'isPassed' => $isPassed,
            'user' => $user,
            'peserta' => $peserta,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'incorrectAnswers' => $incorrectAnswers,
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];

        Log::info('Returning hasil-kompetensi view', ['result' => $result, 'labName' => $labName]);

        return view('hasil-kompetensi-khusus', compact('result', 'labName'));
    }

    public function retryKompetensiKhusus(Request $request)
    {
        $labName = $request->input('labName');
        session()->forget(['answers', 'start_time', 'question_order']);
        return redirect()->route('khusus-dashboard.index', ['labName' => $labName]);
    }
}
