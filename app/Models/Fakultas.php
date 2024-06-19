<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function getFormattedIdAttribute()
    {
        return str_pad((int) $this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }
}
