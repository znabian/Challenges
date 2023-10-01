<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewChallMsg extends Model
{
    use HasFactory;
    protected $table='InterviewChallMsgTbl';
    public function SenderUser()
    {
        return $this->belongsTo(User::class,'Sender','Id');
    }
    
    public function ResiverUser()
    {
        return $this->belongsTo(User::class,'Resiver','Id');
    }
    public function Chat()
    {
        return $this->belongsTo(InterviewChallChat::class,'ChatId','Id');
    }
}
