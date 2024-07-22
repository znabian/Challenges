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

class DirectChatChange implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $SenderId;
    /**
     * Create a new event instance.
     */
    public function __construct($SenderId)
    {
        $this->SenderId  = $SenderId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('DirectChat-Change.'.$this->SenderId);

    } 
    public function broadcastWith() {
        return [
            'SenderId'  => $this->SenderId,
        ];
    }
    public function broadcastAs()
    {
        return 'DirectChatChange';
    }
}
