<?php

namespace App\Http\Controllers;

use App\Models\InterviewChallUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    public function index()
    {
        DB::table('InterviewChallUserTbl')->where('UserId',auth()->user()->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
        $user=User::find(auth()->user()->Id);
        $challs=$user->MyChalls()->whereRaw('((cast(ExpiredAt as Date) >= cast(GETDATE() as Date) and  cast(Date as Date)  <=  cast(GETDATE() as Date)) or cast(ExpiredAt as Date) =  cast(GETDATE() as Date) )')->orderBy('ExpiredAt')->get();//$user->MyChalls()->whereRaw('(cast(ExpiredAt as Date) > GETDATE() and  DATEADD(day, ETime, cast(Date as Date))  <= GETDATE())')->orderBy('Date')->get();//$user->MyChalls()->whereRaw('cast(DATEADD(day, ETime, cast(Date as Date)) as Date) = GETDATE()')->orderBy('Date')->get();
        if(auth()->user()->Age<12)
        return view('panel.child.home',compact('challs'));
        else
        return view('panel.teenager.home',compact('challs'));
    }
    public function history()
    {
        DB::table('InterviewChallUserTbl')->where('UserId',auth()->user()->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
        $user=User::find(auth()->user()->Id);
        $challs=$user->MyChalls()->where(function($query)
        {
            return $query->where('Expired',1)
            ->orWhere('Done',1);
        })->orderByDesc('ExpiredAt')->get();
        if(auth()->user()->Age<12)
        return view('panel.child.history',compact('challs'));
        else
        return view('panel.teenager.history',compact('challs'));
    }
    public function details(InterviewChallUser $chall)
    {   
        if($chall->UserId!=auth()->user()->Id)
        abort(404);
        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        abort(404);    
        DB::table('InterviewChallUserTbl')->where('Id',$chall->Id)->where('Status',0)->update(['Status'=>1]);
        if(auth()->user()->Age<12)
        return view('panel.child.detailes',compact('chall'));
        else
        return view('panel.teenager.detailes',compact('chall'));
    }
}
