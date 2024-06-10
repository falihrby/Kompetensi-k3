<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUjianPilihanPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'peserta_id',
        'kategori_ujian_pilihan'
    ];

    protected $table = 'kategori_ujian_pilihan_peserta'; // Explicitly specify the table name

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
