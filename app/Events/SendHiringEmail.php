<?php

namespace App\Events;

use App\Models\Candidate;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendHiringEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Candidate $candidate;

    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
