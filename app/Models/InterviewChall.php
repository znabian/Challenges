<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewChall extends Model
{
    use HasFactory;
    protected $table='InterviewChallTbl';
    
    public function Creator()
    {
        return $this->belongsTo(User::class,'CreatorId','Id');
    }
    public function Users()
    {
        return $this->hasMany(InterviewChallUser::class,'ChallId','Id')->where('Active',1);
    }
}
