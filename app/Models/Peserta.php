<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama', 'nomor', 'program_studi', 'fakultas', 'instansi', 'email', 'password', 'kategori_ujian_wajib'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function kategoriUjianPilihanPeserta()
    {
        return $this->hasMany(KategoriUjianPilihanPeserta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
