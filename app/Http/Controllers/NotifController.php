<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifController extends Controller
{  
    public function index()
    {
        if(auth()->user()->Age<12)
        return view('panel.child.notification');
        else
        return view('panel.teenager.notification');
    } 
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
       /* DB::table('ReminderTbl')->insert([
            'UserId'=>$data->ResiverId,
            'Body'=>$data->Body,
            'Link'=>$data->url,
            'Seen'=>0,
            'Date'=>$data->Date,
        ]);*/
        DB::table('ReminderTbl')->updateOrInsert([
            'UserId'=>$data->ResiverId,
            'Body'=>$data->Body,
            'Link'=>$data->url],
            ['Seen'=>0,
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
       if(auth()->user()->Age<12)
       foreach(auth()->user()->MyNotifs()->get() as $item)
       {
        $card_body = '
        <div class="card-body">
            <div class="row d-flex">
                <div class="col-1 m-auto" style="padding-right:5px !important;" >                               
                <img src="'.asset('img/child/home/notif.png').'" class="imgicon" alt="">
                </div>
                <div class="col d-flex flex-column" >
                    <div class="p-0">
                        ' . (!$item->Seen ? '<i class="fa fa-circle pull-left status" ></i>' : '<i class="fa pull-left status"></i>') . '
                    </div>
                    <div class="d-flex gap-1 flex-column mx-4" style="padding-right:15px;">                            
                        <span style="font-size: 8pt;">
                            ' . $item->Body . '
                        </span>
                        <span style="font-size: 5pt;font-weight: normal;">
                            
                        </span>
                    </div> 
                    <div class="p-0">
                        <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                            ' . jdate($item->Date)->format('d F - H:i:s') . '
                        </span>
                        <button class="btn-master fa fa-arrow-left-long pull-left p-1" onclick="location.href=\'' . $item->Link . '\'">
                        
                        </button>
                    </div>
                </div>                  
            </div>
        </div>';

            $out.= '<div class="card col-5 p-md-3" onclick="location.href=\'' . $item->Link . '\'">' . $card_body . '</div>';
       }
       else
       foreach(auth()->user()->MyNotifs()->get() as $item)
       {
        $out.='<div class="card mt-2 p-md-3" onclick="location.href=\''.$item->Link.'\'">
        <div class="card-body">
            <div class="row d-flex">
                <div class="col-1 m-auto" style="padding-right:5px !important;" >                               
                        <span class="circle"><i class="fa fa-bell"></i></span>
                </div>
                <div class="col d-flex flex-column" >
                    <div class="p-0">'.(!$item->Seen ? '<i class="fa fa-circle pull-left status"></i>':'<i class="fa pull-left status"></i>').
                    '</div>
                    <div class="d-flex gap-1 flex-column mx-4" style="padding-right:15px;">                            
                        <span style="font-size: 8pt;">'.$item->Body.
                        '</span>
                        <span style="font-size: 5pt;font-weight: normal;">
                            
                        </span>
                    </div> 
                    <div class="p-0">
                        <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                        '.jdate($item->Date)->format('d F - H:i:s').'
                        </span>
                        <button class="btn-master fa fa-arrow-left-long pull-left" onclick="location.href=\''.$item->Link.'\'"></button>
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
