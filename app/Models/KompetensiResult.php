<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'nomor', 'program', 'fakultas', 'instansi', 'kategori_ujian', 'keterangan',
        'waktu_mulai_ujian', 'waktu_selesai_ujian', 'jumlah_soal_benar', 'jumlah_soal_salah',
        'total_questions'
    ];
}

