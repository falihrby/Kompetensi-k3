<?php

use App\Http\Controllers\AkunPesertaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KompetensiUmumController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\SoalKompetensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// For Participants
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// For Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('soal/soal-kompetensi', [SoalKompetensiController::class, 'index'])->name('soal.soal-kompetensi');
    Route::get('prodi/program-studi', [ProgramStudiController::class, 'index'])->name('prodi.program-studi');
    Route::get('fakultas/fakultas', [HomeController::class, 'fakultas'])->name('fakultas.fakultas');
    Route::get('instansi/instansi', [HomeController::class, 'instansi'])->name('instansi.instansi');
    Route::get('akun/akun-peserta', [AkunPesertaController::class, 'index'])->name('akun-peserta.index');

    Route::resource('soal-kompetensi', SoalKompetensiController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.laporan');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/excel', [LaporanController::class, 'exportExcel'])->name('laporan.excel');

    Route::resource('akun-peserta', AkunPesertaController::class);

    Route::resource('program-studi', ProgramStudiController::class);
});

// For General Competency Participants
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kompetensi-umum', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.index');
    Route::get('/kompetensi-umum/{questionNumber?}', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.question');
    Route::get('/kompetensi-umum/questions/{kategori}', [KompetensiUmumController::class, 'fetchQuestions'])->name('kompetensi-umum.fetchQuestions');
    Route::post('/kompetensi-umum/storeJawaban', [KompetensiUmumController::class, 'storeJawaban'])->name('kompetensi-umum.storeJawaban');
    Route::get('/kompetensi-umum/hasil', [KompetensiUmumController::class, 'hasilKompetensi'])->name('kompetensi-umum.hasil');
});

require __DIR__ . '/auth.php';
