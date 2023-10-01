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

class challEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $ResiverId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId,$message)
    {
        $this->message = $message;
        $this->ResiverId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Challenge_Set.'.$this->ResiverId);
    }
    public function broadcastWith() {
        return [
            'Body' => $this->message,
            'ResiverId'  => $this->ResiverId,
            'url'  => 'chall',
            'Date'  => date('Y-m-d H:i:s')
        ];
    }
    public function broadcastAs()
    {
        return 'ChallengeSet';
    }
}
