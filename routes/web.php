<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KompetensiUmumController;
use App\Http\Controllers\SoalKompetensiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/auth/login');
});

// Untuk Peserta
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('soal/soal-kompetensi', [HomeController::class, 'soalKompetensi'])->name('soal.soal-kompetensi');
    Route::get('laporan/laporan', [HomeController::class, 'laporan'])->name('laporan.laporan');
    Route::get('prodi/program-studi', [HomeController::class, 'programStudi'])->name('prodi.program-studi');
    Route::get('fakultas/fakultas', [HomeController::class, 'fakultas'])->name('fakultas.fakultas');
    Route::get('instansi/instansi', [HomeController::class, 'instansi'])->name('instansi.instansi');
    Route::get('akun/akun-peserta', [HomeController::class, 'akunPeserta'])->name('akun.akun-peserta');

    Route::resource('soal-kompetensi', SoalKompetensiController::class);
    Route::put('soal-kompetensi/{soal_kompetensi}', [SoalKompetensiController::class, 'update'])->name('soal-kompetensi.update');
});

// Untuk Peserta Kompetensi Umum
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/kompetensi-umum', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.index');
    Route::get('/kompetensi-umum/{questionNumber?}', [KompetensiUmumController::class, 'index'])->name('kompetensi-umum.index');
    Route::get('/kompetensi-umum/questions/{kategori}', [KompetensiUmumController::class, 'fetchQuestions'])->name('kompetensi-umum.fetchQuestions');
    Route::post('/kompetensi-umum/storeJawaban', [KompetensiUmumController::class, 'storeJawaban'])->name('kompetensi-umum.storeJawaban');
});

require __DIR__ . '/auth.php';
