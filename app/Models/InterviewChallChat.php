<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewChallChat extends Model
{
    use HasFactory;
    protected $table="InterviewChallChatTbl";
    
    public function Sender()
    {
        return $this->belongsTo(User::class,'SenderId','Id');
    }
    
    public function Resiver()
    {
        return $this->belongsTo(User::class,'ResiverId','Id');
    }
    public function ChallUser()
    {
        return $this->belongsTo(InterviewChallUser::class,'ChallUserId','Id');
    }
    public function MSG()
    {
        return $this->hasMany(InterviewChallMsg::class,'ChatId','Id')->where('Active',1);
    }
}
