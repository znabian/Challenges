<?php

namespace App\Http\Controllers;
use Ably\AblyRest;
use App\Events\chatEvent;
use App\Events\closeEvent;
use App\Events\privateEvent;
use App\Events\publicEvent;
use App\Events\seenEvent;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public $ABLY_KEY='fg8Z8w.tNJAiQ:J0hhzygP6hmd0TXqy8P-EqqAEQLVRhA-UZeXl8eBORQ';
    public function ChallengeChat($ChatId,$msgId,$userId,$senderId,$message,$file,$sender,$resiver,$date,$date2,$time,$logo) 
    {
        $a=new chatEvent($ChatId,$msgId,$userId,$senderId,$message,$file,$sender,$resiver,$date,$date2,$time,$logo);

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
    public function ChallengeChatClose($ChatId,$UID) 
    {
        $a=new closeEvent($ChatId,$UID);

        $client = new  AblyRest($this->ABLY_KEY);
        $channel = $client->channels->get('Challenge-Chat-Close.'.$ChatId.'_'.$UID);
        $channel->publish('ChatClose',json_encode($a));
        return true;
    }
}
