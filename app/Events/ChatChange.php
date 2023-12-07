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

class ChatChange implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ChatId;

    /**
     * Create a new event instance.
     */
    public function __construct($ChatId)
    {
        $this->ChatId  = $ChatId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chat-Change.'.$this->ChatId);
    }
    public function broadcastWith() {
        return [
            'ChatId'  => $this->ChatId,
        ];
    }
    public function broadcastAs()
    {
        return 'ChatChange';
    }
}
