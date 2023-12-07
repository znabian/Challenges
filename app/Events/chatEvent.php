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

class chatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $ChatId;
    public $file;
    public $sender;
    public $resiver;
    public $date;
    public $date2;
    public $time;
    public $logo;
    public $msgId;
    public $ResiverId;
    public $SenderId;
    public $Parent;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ChatId,$msgId,$userId,$senderId,$message,$file,$sender,$resiver,$date,$date2,$time,$logo,$parent=null)
    {
        $this->ChatId  = $ChatId;
        $this->message = $message;
        $this->file = $file;
        $this->sender = $sender;
        $this->resiver = $resiver;
        $this->date = $date;
        $this->date2 = $date2;
        $this->time = $time;
        $this->logo = $logo;
        $this->msgId = $msgId;
        $this->ResiverId = $userId;
        $this->SenderId = $senderId; 
        $this->Parent= $parent;       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chat_Messages.'.$this->ChatId.'_'.$this->ResiverId);
    }
    public function broadcastWith() {
        return [
            'Body' => $this->message,
            'ChatId'  => $this->ChatId,
            'File'  => $this->file,
            'Sender'  => $this->sender,
            'Resiver'  => $this->resiver,
            'ResiverId'  => $this->ResiverId,
            'SenderId'  => $this->SenderId,
            'Date'  => $this->date,
            'Date2'  => $this->date2,
            'Time'  => $this->time,
            'Logo'  => $this->logo,
            'msgId'  => $this->msgId,
            'Id'  => $this->msgId,
            "Parent"=>$this->Parent,
            'sender_user' => ['Name'=> $this->sender,"Family"=>'']
        ];
    }
    public function broadcastAs()
    {
        return 'ChatMessages';
    }
}
