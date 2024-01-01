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

class privateEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 
    public $message;
    public $userId;
    public $param;
    public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$userId,$title="موسسه سرخ",$param=[]) 
    {
        $this->message  = $message;
        $this->userId = $userId;
        $this->title = $title;
        $this->param = $param;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return ['sale-channel'];
        //return new PrivateChannel('sale-channel');
        return new PrivateChannel('FCMessages.'.$this->userId);
    }
    public function broadcastWith() {
        return [
            'message' => $this->message,
            'title' => $this->title,
            'user' => $this->userId,
            'url' => $this->param,
        ];
    }
    public function broadcastAs()
    {
        return 'FCMyMessages';
    }
}
