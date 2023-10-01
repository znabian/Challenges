<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewChallUser extends Model
{
    use HasFactory;
    protected $table="InterviewChallUserTbl";
    public function GetStatus($st="all")
    {
        $Status=[
            0=>"درحال انتظار",
            1=>"مشاهده توسط کاربر",
            2=>"درحال انجام",
            3=>"تمدید شد",
            4=>"ثبت نتیجه",
            5=>"رد شد",
        ];      
        if(is_null($st))
        return $Status[0];
        elseif($st=="all")
        return $Status;
        else
            try {
                return $Status[$st];
            } catch (\Throwable $th) {
                return $Status[0];
            }
    }
    public function User()
    {
        return $this->belongsTo(User::class,'UserId','Id');
    }
    
    public function Chall()
    {
        return $this->belongsTo(InterviewChall::class,'ChallId','Id');
    }
    public function Chat()
    {
        return $this->belongsTo(InterviewChallChat::class,'Id','ChallUserId')->where('Active',1);
    }
    public function gettxtStatusAttribute()
    {
        return $this->attributes['txtStatus'] = $this->GetStatus($this->Status);
    }

}
