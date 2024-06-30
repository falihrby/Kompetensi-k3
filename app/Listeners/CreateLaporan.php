<?php

namespace App\Listeners;

use App\Events\KompetensiResultCreated;
use Illuminate\Support\Facades\Log;

class CreateLaporan
{
    public function handle(KompetensiResultCreated $event)
    {
        $kompetensiResult = $event->kompetensiResult;

        // Log the event data instead of creating a new Laporan entry
        Log::info('KompetensiResult Created', [
            'name' => $kompetensiResult->name,
            'nomor_ujian' => $kompetensiResult->nomor,
            'program_studi' => $kompetensiResult->program,
            'fakultas' => $kompetensiResult->fakultas,
            'instansi' => $kompetensiResult->instansi,
            'kategori_ujian' => $kompetensiResult->kategori_ujian,
            'keterangan' => $kompetensiResult->keterangan,
            'waktu_mulai' => $kompetensiResult->waktu_mulai_ujian,
            'waktu_selesai' => $kompetensiResult->waktu_selesai_ujian,
            'total_soal' => $kompetensiResult->total_questions,
            'jumlah_soal_benar' => $kompetensiResult->jumlah_soal_benar,
            'jumlah_soal_salah' => $kompetensiResult->jumlah_soal_salah,
        ]);
    }
}
