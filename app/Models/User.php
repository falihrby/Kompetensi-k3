<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor',
        'usertype',
        'program_studi',
        'fakultas',
        'instansi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi');
    }
}
