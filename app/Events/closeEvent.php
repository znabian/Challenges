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

class closeEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ChatId;
    public $UserId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ChatId,$UserId)
    {
        $this->ChatId  = $ChatId;
         $this->UserId  = $UserId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chat_Close.'.$this->ChatId.'_'.$this->UserId);
    }
    public function broadcastWith() {
        return [
            'ChatId'  => $this->ChatId,
            'Resiver'  => $this->UserId,
        ];
    }
    public function broadcastAs()
    {
        return 'ChatClose';
    }
}
