<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKompetensi extends Model
{
    use HasFactory;

    protected $table = 'soal_kompetensi';
    protected $fillable = [
        'kategori',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban',
        'gambar',
    ];

    public function getFormattedIdAttribute()
    {
        return str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }
}
