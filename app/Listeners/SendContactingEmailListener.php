<?php

namespace App\Listeners;

use App\Events\SendContactingEmail;
use App\Mail\ContactedEmail;
use App\Models\Candidate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactingEmailListener implements ShouldQueue
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
    public function handle(SendContactingEmail $event)
    {
        Mail::to($event->candidate->email)->send(new ContactedEmail($event->candidate));
    }
}
