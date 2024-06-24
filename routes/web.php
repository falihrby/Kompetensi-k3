<?php

// File: routes/web.php

use App\Http\Controllers\AkunPesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KompetensiKhususController;
use App\Http\Controllers\KompetensiUmumController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SoalKompetensiController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('auth.login');
})->name('home');

// Authentication Routes
require __DIR__ . '/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // General Competency Participant Routes
    Route::prefix('kompetensi-umum')->group(function () {
        Route::get('/hasil', [KompetensiUmumController::class, 'hasilKompetensi'])->name('kompetensi-umum.hasil');
        Route::get('/', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.index');
        Route::get('/question/{questionNumber?}', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.question');
        Route::get('/questions/{kategori}', [KompetensiUmumController::class, 'fetchQuestions'])->name('kompetensi-umum.fetchQuestions');
        Route::post('/store-jawaban', [KompetensiUmumController::class, 'storeJawaban'])->name('kompetensi-umum.storeJawaban');
        Route::post('/reset-jawaban', [KompetensiUmumController::class, 'resetJawaban'])->name('kompetensi-umum.resetJawaban');
        Route::post('/retry-kompetensi', [KompetensiUmumController::class, 'retryKompetensi'])->name('retry-kompetensi');
    });

    // Route to show the lab selection page
    Route::get('/pilih-lab', [LabController::class, 'show'])->name('pilih-lab');
    Route::get('/Dashboard/{labName?}', [LabController::class, 'index'])->name('khusus-dashboard.index');
    Route::get('/hasil-akhir', [ResultController::class, 'show'])->name('hasil-akhir');

    // Specific Competency Participant Routes
    Route::prefix('kompetensi-khusus')->group(function () {
        Route::get('/kompetensi-khusus/{labName}', [KompetensiKhususController::class, 'index'])->name('kompetensi-khusus.index');
        Route::post('/store-jawaban', [KompetensiKhususController::class, 'storeJawaban'])->name('kompetensi-khusus.storeJawaban');
        Route::get('/hasil', [KompetensiKhususController::class, 'hasilKompetensi'])->name('kompetensi-khusus.hasil');
        Route::post('/retry-kompetensikhusus', [KompetensiKhususController::class, 'retryKompetensiKhusus'])->name('retry-kompetensikhusus');
    });

    // Participant Routes
    Route::middleware(['verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/cetak-sertifikat', [DashboardController::class, 'cetakSertifikat'])->name('sertifikat-peserta');
    });

    // Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

        // Program Studi Routes
        Route::resource('program-studi', ProgramStudiController::class);

        // Fakultas Routes
        Route::resource('fakultas', FakultasController::class);

        // Instansi Routes
        Route::resource('instansi', InstansiController::class);

        // Akun Peserta Routes
        Route::resource('akun-peserta', AkunPesertaController::class);

        // Soal Kompetensi Routes
        Route::get('soal/soal-kompetensi', [SoalKompetensiController::class, 'index'])->name('soal.soal-kompetensi');
        Route::resource('soal-kompetensi', SoalKompetensiController::class);

        // Laporan Routes
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
        Route::get('/cetak-laporan', [LaporanController::class, 'cetakPeserta'])->name('laporan.cetak-laporan');
    });
});
