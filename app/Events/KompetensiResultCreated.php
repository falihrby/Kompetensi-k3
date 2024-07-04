<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\KompetensiResult;

class KompetensiResultCreated
{
    use Dispatchable, SerializesModels;

    public $kompetensiResult;

    public function __construct(KompetensiResult $kompetensiResult)
    {
        $this->kompetensiResult = $kompetensiResult;
    }
}
