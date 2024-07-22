<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DirectSeen implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $SenderId;
    public $ResiverId;
    /**
     * Create a new event instance.
     */
    public function __construct($SenderId,$ResiverId)
    {
        $this->SenderId  = $SenderId;
         $this->ResiverId  = $ResiverId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('Direct-Chat-Seen.8_'.$this->SenderId),
        ];
    }
    public function broadcastWith() {
        return [
            'SenderId'  => $this->SenderId,
            'Resiver'  => $this->ResiverId,
        ];
    }
    public function broadcastAs()
    {
        return 'DirectChatSeen';
    }
}
