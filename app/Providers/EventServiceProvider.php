<?php

namespace App\Providers;

use App\Events\KompetensiResultCreated;
use App\Listeners\CreateLaporan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\InsertKelulusanIfPassed;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        KompetensiResultCreated::class => [
            CreateLaporan::class,
        ],
        KompetensiResultCreated::class => [
            InsertKelulusanIfPassed::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
