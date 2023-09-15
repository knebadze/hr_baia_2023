<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class hrDailyJob
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hr_id;
    public $filed;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($hr_id, $filed)
    {
        $this->hr_id = $hr_id;
        $this->filed = $filed;
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
