<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class staffDailyJob
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $staff_id;
    public $filed;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($staff_id, $filed)
    {
        $this->staff_id = $staff_id;
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
