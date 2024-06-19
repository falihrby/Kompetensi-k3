<?php
// File: app/Events/KompetensiResultCreated.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KompetensiResultCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $kompetensiResult;

    public function __construct($kompetensiResult)
    {
        $this->kompetensiResult = $kompetensiResult;
    }
}

