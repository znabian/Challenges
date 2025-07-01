<?php

namespace App\Http\Controllers;
use Ably\AblyRest;
use App\Events\ChatChange;
use App\Events\chatEvent;
use App\Events\closeEvent;
use App\Events\DirectChatChange;
use App\Events\DirectSeen;
use App\Events\privateEvent;
use App\Events\publicEvent;
use App\Events\seenEvent;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //public $ABLY_KEY='900Xog.XhH1eQ:aV0Kdq_mJUTBt5KUsgQvHTdtjbUAaXHAkHvVanuuG9U';
    public $ABLY_KEY='fg8Z8w.tNJAiQ:J0hhzygP6hmd0TXqy8P-EqqAEQLVRhA-UZeXl8eBORQ';
    public function ChallengeChat($ChatId,$msgId,$userId,$senderId,$message,$file,$sender,$resiver,$date,$date2,$time,$logo,$parent=0) 
    {
        $a=new chatEvent($ChatId,$msgId,$userId,$senderId,$message,$file,$sender,$resiver,$date,$date2,$time,$logo,$parent);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Challenge-Chat-Messages.'.$ChatId.'_'.$userId);
        $channel->publish('ChatMessages', json_encode($a->broadcastWith()));
        return true;
    }
    public function ChallengeChatSeen($ChatId,$UID) 
    {
        $a=new seenEvent($ChatId,$UID);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Challenge-Chat-Seen.'.$ChatId.'_'.$UID);
        $channel->publish('ChatSeen',json_encode($a->broadcastWith()));
        return true;
    }
    public function ChallengeChatChange($ChatId) 
    {
        $a=new ChatChange($ChatId);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Challenge-Chat-Change.'.$ChatId);
        $channel->publish('ChatChange',json_encode($a->broadcastWith()));
        return true;
    }
    public function ChallengeChatClose($ChatId,$UID) 
    {
        $a=new closeEvent($ChatId,$UID);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Challenge-Chat-Close.'.$ChatId.'_'.$UID);
        $channel->publish('ChatClose',json_encode($a));
        return true;
    }
    public function PrivateMessage($message,$userId,$title="موسسه سرخ",$param=[]) 
    { 
        $a=new privateEvent($message,$userId,$title,$param);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('FC-Messages.'.$userId);
        $channel->publish('FCMyMessages', json_encode($a->broadcastWith()));
        return true;
    }
    public function DirectChatSeen($UID) 
    {
        $a=new DirectSeen($UID,8);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Direct-Chat-Seen.8_'.$UID);
        $channel->publish('DirectChatSeen',json_encode($a->broadcastWith()));
        return true;
    }
    public function DirectChatChanges($SenderId) 
    {
        $a=new DirectChatChange($SenderId);
        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('DirectChat-Change-'.$SenderId);
        $channel->publish('DirectChatChange',json_encode($a->broadcastWith()));
        return true;
    }
    public function ReserveWork($city) 
    {
        //$a=new ReservationEvent('work');

        try {
        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('workReserve-Change.'.$city);
        $channel->publish('workReserveChange','');
        return true;
        } catch (\Throwable $th) {
           return false;
        }
       
    }
}
