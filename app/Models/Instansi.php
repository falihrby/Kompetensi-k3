<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansi';
    protected $fillable = ['id', 'name'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function getFormattedIdAttribute()
    {
        return str_pad((int) $this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }
}
