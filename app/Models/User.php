<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'UserTbl';
    protected $username = 'Phone';
    protected $primaryKey = 'Id';
    protected $fillable = [
        'Phone', 'Pass',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function getAuthPassword() {
        return $this->Pass;
    }
    public function getAuthUsername() {
        return $this->Phone;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    
       
        public function getFullNameAttribute()
        {
            return $this->attributes['FullName'] = $this->Name . ' ' . $this->Family;
        } 
        public function getAgeAttribute()
        {
            if($this->BirthDay)
            {
                list($y,$m,$d)=explode('-',$this->BirthDay);
               $age=(jdate(now())->format('Y'))-$y;
            }
            else
            $age=8;
            return $this->attributes['Age'] = $age;
        }        
        public function MyChalls()
        {
            return $this->hasMany(InterviewChallUser::class,'UserId','Id')->where('Active',1);
        }      
        public function MyNotifs()
        {
            return $this->hasMany(Notif::class,'UserId','Id')->orderByDesc('Date');
        }     
        public function MyNewNotifs()
        {
            return $this->hasMany(Notif::class,'UserId','Id')->where('Seen',0);
        }
}
