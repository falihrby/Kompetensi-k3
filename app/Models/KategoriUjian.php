<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
