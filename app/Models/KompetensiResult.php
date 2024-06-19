<?php

// File: app/Models/KompetensiResult.php

namespace App\Models;

use App\Events\KompetensiResultCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiResult extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => KompetensiResultCreated::class,
    ];

    protected $fillable = [
        'name', 'nomor', 'program', 'fakultas', 'instansi', 'kategori_ujian',
        'keterangan', 'waktu_mulai_ujian', 'waktu_selesai_ujian', 'total_questions',
        'jumlah_soal_benar', 'jumlah_soal_salah',
    ];
}
