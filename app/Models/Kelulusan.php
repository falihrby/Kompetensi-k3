<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;

    protected $table = 'kelulusan';

    protected $fillable = [
        'user_id',
        'nama',
        'nomor',
        'program_studi',
        'fakultas',
        'instansi',
        'keterangan',
    ];

    /**
     * Check if the user has passed all exams.
     */
    public static function checkIfPassed(int $userId): bool
    {
        return self::where('user_id', $userId)->exists();
    }
}
