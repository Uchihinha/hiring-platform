<?php

namespace App\Listeners;

use App\Events\SendHiringEmail;
use App\Mail\HiredEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendHiringEmailListener implements ShouldQueue
{
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendHiringEmail $event)
    {
        Mail::to($event->candidate->email)->send(new HiredEmail($event->candidate));
    }
}
