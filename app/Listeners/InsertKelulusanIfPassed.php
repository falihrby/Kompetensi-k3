<?php

namespace App\Listeners;

use App\Events\KompetensiResultCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\KompetensiResult;
use Illuminate\Support\Facades\Log;

class InsertKelulusanIfPassed
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\KompetensiResultCreated  $event
     * @return void
     */
    public function handle(KompetensiResultCreated $event)
    {
        Log::info('Event KompetensiResultCreated received', ['user_id' => $event->kompetensiResult->user_id]);
        KompetensiResult::insertKelulusanIfPassed($event->kompetensiResult->user_id);
    }
}
