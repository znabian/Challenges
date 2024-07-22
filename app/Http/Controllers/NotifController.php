<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class NotifController extends Controller
{  
    private $api_token;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
    }
    public function index()
    {
        $user=session('User');
        $this->getData('select',['uid'=>$user->Id],'index',"Notifs"); 
        
        $notifs=session('Notifs');
        $this->getData('update',['uid'=>$user->Id],'seen',"Notifs"); 
        if(!session('Notifs')->count())
            session()->forget('Notifs');
        if($user->Age<12)
        return view('panel.child.notification',compact('notifs'));
        else
        return view('panel.teenager.notification',compact('notifs'));
    } 
    public function insert(Request $req)
    {
        $data=json_decode($req->get('data'));
        if($data->url=='chall')
        {
            $data->url=route("home");
        }
        elseif($data->url=='message')
        { 
            $data->url="/message";
        }
        else
        { 
            $data->url="/chat/".$data->ChatId;
        }
        $this->getData('updateinsert',['uid'=>$data->ResiverId,'body'=>$data->Body, 'link'=>$data->url,'date'=>$data->Date],'insert');
        
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
        $user=session('User');
        $this->getData('update',['link'=>$data->url,'uid'=>$data->ResiverId],'seenOne',"Notifs"); 
        if(!session('Notifs')->count())
            session()->forget('Notifs');

        return 1;
        
    }
    public function ajaxNotif(Request $req)
    {     
        $user=session('User');  
       $out='';
       $this->getData('select',['uid'=>$user->Id],'index',"Notifs"); 
       if($user->Age<12)
       foreach(session('Notifs') as $item)
       {
        $item = (object)($item);
        $out.= '
        <div class="card col-5 mt-2 p-md-3" onclick="location.href=\''.$item->Link.'\'">
        <div class="card-body d-grid gap-1 text-center">
            <div class="">
            ' . (!$item->Seen ? '<i class="fa fa-circle pull-left status" ></i>' : '<i class="fa pull-left status"></i>') . '
      
                <img src="'.asset('img/child/home/notif.png').'" class="imgicon" alt="">
                </div>
                <div>
                
                <span style="font-size: 8pt;">
                            ' . $item->Body . '
                        </span>
                        <br>
                        <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                            '.ltrim(jdate($item->Date)->format('d F ساعت  H:i'),'0').'
                        </span>
                    </div> 
                        <button class="btn-master fa fa-arrow-left-long pull-left m-auto" onclick="location.href=\'' . $item->Link . '\'"></button>
                    </div>
                </div>';

            
       }
       else
       foreach(session('Notifs') as $item)
       {
        $item = (object)($item);
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
       $this->getData('update',['uid'=>$user->Id],'seen',"Notifs"); 
       if(!session('Notifs')->count())
           session()->forget('Notifs');
       if($out)
        $res=['success'=>1,'data'=>$out];
        else
        $res=['success'=>0];
        return response()->json($res);
        
    }
    public function getData($type,$param,$function,$sName=null)
    {
        if($type=="update")
        $url="http://185.116.161.39/API/updateApi_jwt.php";
        elseif($type=="updateinsert")
        $url="http://185.116.161.39/API/updateOrInserApi_jwt.php";
        else
        $url="http://185.116.161.39/API/selectApi_jwt.php";
        switch ($function) {
            case 'index':
                $select="select * from ReminderTbl where UserId=".$param['uid']." order By Date desc";
                $update="";
                break;
            case 'seen':
                $select="select * from ReminderTbl where UserId=".$param['uid']." and Seen=0 order By Date desc";
                $update="update ReminderTbl set Seen=1 where UserId=".$param['uid']." and Seen=0 ";
                break;
            case 'seenOne':
                $select="select * from ReminderTbl where UserId=".$param['uid']." and Seen=0 order By Date desc";
                $update="update ReminderTbl set Seen=1 where UserId=".$param['uid']." and Seen=0 and Link=".$param['link'];
                break;
            case 'insert':
                $select="select Id from ReminderTbl where UserId=".$param['uid']." and Body=N'".$param['body']."'and Link='".$param['link']."'";
                $update="update ReminderTbl set Seen=0 , Date='".$param['date']."'  where UserId= ".$param['uid']." and Id=?";
                $insert="INSERT INTO ReminderTbl (UserId, Body, Link, Seen, Date) VALUES ('".$param['uid']."', N'".$param['body']."', '".$param['link']."', 0, '".$param['date']."')";
                break;
            
            default:
                # code...
                break;
        }
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',           
                'api_token' => $this->api_token,
            ])->asForm()->post($url,['update' => $update,'data' => $select,'insert'=>$insert??'']);
            if($sName)
            {
                if($response->ok())
                {
                    $data=$response->json(); 
                    if($data['status']==200)
                    $challs=collect($data['data']); 
                    else
                    $challs=collect([]); 
                    
                }
                else
                $challs=collect([]); 
                session([$sName=>$challs]);
            }
            return true;
    }

   /** SQl Server */
    public function index_SQL()
    {
        if(auth()->user()->Age<12)
        return view('panel.child.notification');
        else
        return view('panel.teenager.notification');
    } 
    public function insert_SQL(Request $req)
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
    public function seen_SQL(Request $req)
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
    public function ajaxNotif_SQL(Request $req)
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
