<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nomor_ujian',
        'program_studi',
        'fakultas',
        'instansi',
        'kategori_ujian',
        'keterangan',
        'waktu_mulai',
        'waktu_selesai',
        'total_soal',
        'jumlah_soal_benar',
        'jumlah_soal_salah'
    ];
}
