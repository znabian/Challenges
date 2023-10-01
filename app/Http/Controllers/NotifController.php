<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifController extends Controller
{   
    public function insert(Request $req)
    {
        $data=json_decode($req->get('data'));
        if($data->url=='chall')
        {
            $data->url=route("home");
        }
        else
        { 
            $data->url="/chat/".$data->ChatId;
        }
        DB::table('ReminderTbl')->insert([
            'UserId'=>$data->ResiverId,
            'Body'=>$data->Body,
            'Link'=>$data->url,
            'Seen'=>0,
            'Date'=>$data->Date,
        ]);
        return 1;
        
    }
    public function seen(Request $req)
    {
        $data=(object)$req->get('data');
        if($data->url=='chall')
        {
            $data->url=route("home");
        }
        else
        { 
            $data->url="/chat/".$data->ChatId;
        }
        DB::table('ReminderTbl')->where([
            'UserId'=>$data->ResiverId,
            'Link'=>$data->url,
            'Seen'=>0
        ])->update(['Seen'=>1]);
        return 1;
        
    }
    public function ajaxNotif(Request $req)
    {       
       $out='';
       foreach(auth()->user()->MyNotifs()->get() as $item)
       {
        $out.='
        <div class="card mt-2 p-md-3">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-1 m-auto">
                        <span class="circle"><i class="fa fa-bell"></i></span>
                    </div>
                    <div class="col d-flex flex-column">
                        <div class="p-0">'.(!$item->Seen ? '<i class="fa fa-circle pull-left status"></i>':'<i class="fa pull-left status"></i>').
                       '</div>
                        <div class="d-flex flex-column mx-4">
                            <span style="font-size: 8pt;">'.$item->Body.
                            '</span>
                            <span style="font-size: 5pt;font-weight: normal;"></span>
                        </div>
                        <div class="p-0">
                            <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                                '.jdate($item->Date)->format('d F - H:i:s').'
                            </span>
                            <button class="btn-master fa fa-arrow-left-long p-1 pull-left" onclick="location.href=\''.$item->Link.'\'"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
       }
      DB::table('ReminderTbl')->where('UserId',auth()->user()->Id)->update(['Seen'=>1]);

       if($out)
        $res=['success'=>1,'data'=>$out];
        else
        $res=['success'=>0];
        return response()->json($res);
        
    }
}
