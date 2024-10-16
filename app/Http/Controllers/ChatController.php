<?php

namespace App\Http\Controllers;

use App\Models\InterviewChallChat;
use App\Models\InterviewChallMsg;
use App\Models\InterviewChallUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ChatController extends Controller
{ 
    private $api_token;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
    }
    public function index($chall)
    {   
        $user=session('User'); 
        $panel=new PanelController();

        $MySupport=$panel->getData('select',['uid'=>$user->Id],'MySupport',1);       
        if($MySupport->count()) 
        {
            $user->SellerId=$MySupport->first()['SellerId'];
            $user->SupportId=$MySupport->first()['SupportId'];
            //session()->forget('User');    
            session(['User'=>$user]);
        }
        
        $panel->getData('update',['uid'=>$user->Id],'index',"Challs"); 
        $panel->getData('update',['uid'=>$user->Id],'history',"Histories");  
        $challs=(session('Challs'));
        $challs=$challs->merge((session('Histories')));
        if($challs->where('Id',$chall)->count()==0) 
        abort(404);
        $chall=(object)$challs->where('Id',$chall)->first();
       
        if($chall->UserId!=$user->Id)
        abort(404);
        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        abort(404);

        /*if(!$chall->ChatId && $chall->Expired)
        {
            session()->flash('error','زمان تحویل این چالش گذشته است');
            return back();
        }*/
        $this->getData('update',['uid'=>$user->Id,'link'=>"/chat/".$chall->Id],'seen',"Notifs"); 
       if(!session('Notifs')->count())
           session()->forget('Notifs');        

        if(!$chall->ChatId)
        {
            $chall->ChatId=$this->getData('createchat',['sender'=>$user->Id,'resiver'=>$user->SellerId??$user->SupportId,'cuid'=>$chall->Id],'chat',1)[0]; 
            $chall->ChatResiver=$user->SellerId??$user->SupportId; 
        }

        if(!$chall->Closed)
        $this->getData('update',['resiver'=>$user->Id,'cid'=>$chall->ChatId],'read'); 
       
        $chats=$this->getData('select',['cid'=>$chall->ChatId],'msg',1); 
        $quiz=$this->getData('select',[],'faq',1); 
        
        $EventController=new EventController();
        $EventController->ChallengeChatSeen($chall->ChatId,$chall->ChatResiver);
        if($user->Age<12)
        return view('panel.child.chat',compact('chall','chats','quiz'));
        else
        return view('panel.teenager.chat',compact('chall','chats','quiz'));
    }
    public function send_message(Request $req)
    {
        $user=session('User');
        if($req->hasFile('file'))
            {
                $file=$req->file('file');
                $fileName=$req->Resiver . '_'.$req->Sender;
                if(Str::contains($file->getClientMimeType(),'video'))
                $fileName.='_movie__'; 
                elseif(Str::contains($file->getClientMimeType(),'image'))
                $fileName.='_image__'; 
                else
                $fileName.='_file__'; 

                $fileName.=time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}";
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                    //$file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                     $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/'.$fileName;
            }
            elseif ($req->hasFile('voice'))
            {
                $file=$req->file('voice');
                    $fileName=$req->Resiver . '_'.$req->Sender.'_voice__'.time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}"; //$file->extension()
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio'))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio');
                     $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
                     //$file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
                    $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/'.$fileName;
            }
            else
            $path='';
            $chatId=$this->getData('insertGetId',['ChatId'=>$req->ChatId,'Sender'=>$req->Sender,'Resiver'=>$req->Resiver,'Body'=>$req->Body??null,'File'=>$path,"Seen"=>0,'Parent'=>$req->Parent??null],'sendmsg',1)[0];
            $msg=(object)$this->getData('select',['cmid'=>$chatId],'Getmsg',1)[0];
            $logo=asset('dist/img/Logored.png');               
            $EventController=new EventController();
            if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');
            $def=$this->getData('select',['sid'=>$user->SellerId??$user->SupportId],'automsg',1) ;
            if($def->count())
            {
                $def=(object)$def->first();
                if(in_array(date('D'),explode(',',$def->Days)))
                {
                    $dt=date_create($msg->Date);
                    if($def->STime<=$dt->format('H:i:s') && $def->ETime>=$dt->format('H:i:s') )
                    {
                        $chatId2=$this->getData('insertGetId',['ChatId'=>$req->ChatId,'Sender'=>$req->Resiver,'Resiver'=>$req->Sender,'Body'=>$def->Message,'File'=>'',"Seen"=>0,'Parent'=>$msg->Id],'sendmsg',1)[0];
                        $EventController->ChallengeChatChange($req->ChatId);
                        return response()->json(['success'=>1,'chatId'=>$chatId,'Body'=>$msg->Body,'Parent'=>$msg->Parent,'File'=>$path,'Sender'=>$msg->SenderName,'Logo'=>$logo,'Date'=>jdate($msg->Date)->format('Y-m-d H:i:s'),'Date2'=>$date2,"Time"=>jdate($msg->Date)->format('H:i:s'),'ResiverId'=>$msg->Resiver,'SenderId'=>$msg->Sender,'msg'=>$msg]);

                    }
                }
            }
            $EventController->ChallengeChat($req->ChatId,$chatId,$msg->Resiver,$msg->Sender,$msg->Body??null,$path,$msg->SenderName,$msg->ResiverName,jdate($msg->Date)->format('Y-m-d H:i:s'),$date2,jdate($msg->Date)->format('H:i:s'),$logo,$msg->Parent);
            $challs=(session('Challs'));
            $challs=$challs->merge((session('Histories')));
            $chall=(object)$challs->where('Id',$req->ChallId)->first();
            
            $EventController->PrivateMessage(" یک پیام جدید در چالش ".$chall->Title." از ".$msg->SenderName." دریافت شد ",$msg->Resiver,'چالش های فرست کلاس',$req->ChallId);
			$EventController->ChallengeChatChange($req->ChatId);
            return response()->json(['success'=>1,'chatId'=>$chatId,'Body'=>$msg->Body,'Parent'=>$msg->Parent,'File'=>$path,'Sender'=>$msg->SenderName,'Logo'=>$logo,'Date'=>jdate($msg->Date)->format('Y-m-d H:i:s'),'Date2'=>$date2,"Time"=>jdate($msg->Date)->format('H:i:s'),'ResiverId'=>$msg->Resiver,'SenderId'=>$msg->Sender,'msg'=>$msg]);
    }
    public function All_chat($chat,Request $req)
    {
        $msgs=$this->getData('select',['cid'=>$chat],'msg',1); 
        return response()->json(['success'=>1,'msgs'=>$msgs]);
    }
    public function edit_message(Request $req)
    {
        $msg=(object)$this->getData('select',['cmid'=>$req->Id],'Getmsg',1)[0];
        $update=json_decode($msg->Updates);
        $update[]=['body'=>$msg->Body,'date'=>date('Y-m-d H:i:s')];
        $update=json_encode($update,1);
        unset($msg);
        $msgs=$this->getData('update',['Id'=>$req->Id,'Body'=>$req->Body??null,'ChatId'=>$req->ChatId,'Updates'=>$update],'editmsg',1);
                  
        $EventController=new EventController();
        
        $EventController->ChallengeChatChange($req->ChatId);
        return response()->json(['success'=>1,'msgs'=>$msgs]);
    }
    public function delete_message(Request $req)
    {
        $msgs=$this->getData('update',['Id'=>$req->Id,'ChatId'=>$req->ChatId],'delmsg',1);
        $msg=$msgs->first();
         $logo=asset('dist/img/Logored.png');               
        $EventController=new EventController();
        $EventController->ChallengeChatChange($req->ChatId);
        /*if($msg)
        {
            $msg=(object)$msg;
             if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');
            return response()->json(['success'=>1,'chatId'=>$req->ChatId,'Body'=>$msg->Body,'File'=>$msg->File,'Sender'=>$msg->SenderName,'Logo'=>$logo,'Date'=>jdate($msg->Date)->format('Y-m-d H:i:s'),'Date2'=>$date2,"Time"=>jdate($msg->Date)->format('H:i:s'),'ResiverId'=>$msg->Resiver,'SenderId'=>$msg->Sender]);
        }
        else*/
        return response()->json(['success'=>1,'msgs'=>$msgs]);
        
       
    }
    public function read_chat($chat,Request $req)
    {
        $user=session('User'); 
        $this->getData('update',['resiver'=>$req->Resiver,'cid'=>$chat],'read'); 
       
        $this->getData('update',['uid'=>$user->Id,'link'=>"chat/".$req->Chall],'seen',"Notifs"); 
       if(!session('Notifs')->count())
           session()->forget('Notifs');       

        $EventController=new EventController();
        $EventController->ChallengeChatSeen($chat,$req->Sender);
         return response()->json(['success'=>1]);
    }
    public function ajaxDetailes(Request $req)
    {       
        $user=session('User'); 
        $panel=new PanelController();
        $panel->getData('update',['uid'=>$user->Id],'index',"Challs");        
       
        $challs=session('Challs');
        $out='';
        if($user->Age<12)
            foreach($challs as $item)
            {
                $item=(object)$item;
                $card_body = '<div class="card-body d-grid gap-1 text-center">';
                $status = '';
                if ($item->Done) {
                    $status = '<i class="fa fa-check pull-left status"></i>';
                } else {
                    $status = '<i class="fa fa-close pull-left status"></i>';
                }

                $card_body .= $status;

                if ($item->Options ?? 0) {
                    $card_body .= '<img src="' . asset('img/child/home/quiz.png') . '" class="imgicon" alt="' . $item->Type . '">';
                } elseif (in_array($item->Type ?? 'text', ['image', 'audio', 'text', 'movie'])) {
                    $card_body .= '<img src="' . asset('img/child/home/' . $item->Type . '.png') . '" class="imgicon" alt="' . $item->Type . '">';
                } else {
                    $card_body .= '<img src="' . asset('img/child/home/text.png') . '" class="imgicon" alt="' . $item->Type . '">';
                }

                $card_body .= '<b class="title">' . $item->Title . '</b>';
                $item->Body=strtr($item->Body,['%کاربر%'=> session('User')->Name]);
                $card_body .= '<span class="subtitle">' . Str::limit($item->Body, 26, '...') . '</span>';

                $card_body .= '<span class="subtitle fw-bold">تا  '.ltrim(jdate($item['ExpiredAt'])->format('d ام F ماه'),'0').'</span>';
                $card_body .= '<button style="" class="btn-master fa fa-arrow-left-long pull-left m-auto" onclick="location.href=' . route('chall.details', [$item->Id]) . '"></button>';
                $card_body .= '</div>';

                $card = '<div class="card col-5 mt-2 p-md-3" onclick="location.href=' . route('chall.details', [$item->Id]) . '">' . $card_body . '</div>';


                $out.=$card;
            }
       else
            foreach($challs as $item)
            {
                $item=(object)$item;
                $out.='<div class="card mt-2 p-md-3" onclick="location.href=\''.route('chall.details',[$item->Id]).'\'">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >';                                
                                    if($item->Options??0)                   
                                    $out.='<img src="'.asset('img/home/quiz.png').'" class="imgicon" alt="'.$item->Type.'">';
                                    elseif(in_array($item->Type??'text',['image','audio','text','movie']))                              
                                    $out.='<img src="'.asset('img/home/'.$item->Type.'.png').'" class="imgicon" alt="'.$item->Type.'">';
                                    else
                                    $out.='<img src="'.asset('img/home/text.png').'" class="imgicon" alt="'.$item->Type.'">';
                                    
                                $out.='</div>
                                <div class="col d-flex flex-column pt-0" style="border-right: 2px solid #edc587;margin-right: 16px;">
                                    <div class="" style="margin-left: -2px;margin-top: -2px;">
                                    ' . ($item->Done ? '<i class="fa fa-check pull-left status"></i>' : ($item->Expired ? '<i class="fa fa-exclamation pull-left status"></i>' : '<i class="fa fa-close pull-left status"></i>')) . '                               
                                    </div>
                                    <div class="d-flex gap-2 flex-column mx-4" style="margin-right:0.25rem!important;">                                
                                        <b class="h6 title text-lg-end text-sm-center " >' . $item->Title . '</b>
                                        <span class="subtitle">';
                                        $item->Body= strtr($item->Body,['%کاربر%'=> session('User')->Name]);

                                        $out.=Str::limit($item->Body, 30, '...') . '
                                        </span>
                                    </div> 
                                    <div class="p-0">
                                    <span class="subtitle fw-bold">
                                        تا  '.ltrim(jdate($item['ExpiredAt'])->format('d ام F ماه'),'0').'
                                    </span>
                                        <button style="font-size: 9pt;"  class="btn-master fa fa-arrow-left-long pull-left p-1" onclick="location.href=\'' . route('chall.details', [$item->Id]) . '\'"></button>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                    </div>';
            }
       if($out)
        $res=['success'=>1,'data'=>$out];
        else
        $res=['success'=>0];
        return response()->json($res);
        
    }
    
    public function ajaxSetAnswer(Request $req)
    { 
        $user=session('User');
        $panel=new PanelController();
        $panel->getData('update',['uid'=>$user->Id,'cid'=>$req->chall],'details',"Chall"); 
        $wallet=$panel->MyWallet($user->Id)->getData()->wallet??'-';
        
        $chall=session('Chall');
        if(session('Chall')->where('Id',$req->chall)->count()==0)
        return response()->json(['success'=>0,'msg'=>"چالشی پیدا نکردم"]);
        $chall=(object)session('Chall')->where('Id',$req->chall)->first();
        if($chall->UserId!=$user->Id)
        return response()->json(['success'=>0,'msg'=>"چالشی پیدا نکردم"]);

        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        return response()->json(['success'=>0,'msg'=>"چالشی پیدا نکردم"]);
       /* if(!$chall->ChatId && $chall->Expired)
        return response()->json(['success'=>0,'msg'=>"زمان چالشت تموم شده"]);*/
        
        if($chall->Closed??0)
        return response()->json(['success'=>0,'msg'=>"چالشت بسته شده"]);

        if(!$chall->ChatId)
        {
            $chall->ChatId=$this->getData('createchat',['sender'=>$user->Id,'resiver'=>$user->SellerId??$user->SupportId,'cuid'=>$chall->Id],'chat',1)[0]; 
            $chall->ChatResiver=$user->SellerId??$user->SupportId; 
        }
        $Body="پاسخ این سوال  ".$req->answer." است";
        if($chall->MyAnswer==$Body)
        {
            return response()->json(['success'=>1,'msg'=>"جوابت ثبت شده بود"]);
        }
        $chats=$this->getData('select',['cid'=>$chall->ChatId],'msg',1); 
        if($chats->where("Body",'like',"%$Body%")->count()==0)
        {
            $chatId=$this->getData('insertGetId',['ChatId'=>$chall->ChatId,'Sender'=>$user->Id,'Resiver'=>$chall->ChatResiver,'Body'=>$Body,"Seen"=>0,'Parent'=>null],'sendmsg',1)[0];
            $msg=(object)$this->getData('select',['cmid'=>$chatId],'Getmsg',1)[0];
        }
        else
        $msg=$chats->where("Body",'like',"%$Body%")->first();
        $answers=json_decode($chall->Options??'[]');   
        $correct=($req->answer==$answers->ans);  
        $f= date_diff(date_create(explode(' ',$chall->ExpiredAt)[0]),date_create(date('Y-m-d')))->format("%R%a");
        $price=60000-(($f>2)?$f-1:0)*10000;
        if($price<10000)
        $price=10000;      
        $this->getData('update',['id'=>$chall->Id,'answer'=>$msg->Id,'correct'=>$correct,'ChatId'=>$chall->ChatId,'Price'=>$price],'setAnswer');
        
        
            /*$logo=asset('dist/img/Logored.png');                    
            $EventController=new EventController();
            if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');
            $EventController->ChallengeChat($chall->ChatId,$msg->Id,$msg->Resiver,$msg->Sender,$msg->Body??null,'',$msg->SenderName,$msg->ResiverName,jdate($msg->Date)->format('Y-m-d H:i:s'),$date2,jdate($msg->Date)->format('H:i:s'),$logo);*/
        if($correct)
        return response()->json(['success'=>1,'wallet'=>$wallet+$price,'msg'=>session('User')->FullName." آفرین! جواب درست رو انتخاب کردی و ".number_format($price)." تومان پاداش گرفتی"]);
        else
        return response()->json(['success'=>2,'wallet'=>$wallet,'msg'=>session('User')->FullName." عزیز! جوابت اشتباه بود و پاداش  ".number_format($price)." تومانی رو از دست دادی"]);
    }
    public function send_quiz(Request $req)
    {
        $user=session('User');
        if($req->hasFile('file'))
            {
                $file=$req->file('file');
                $fileName=$req->Resiver . '_'.$req->Sender;
                if(Str::contains($file->getClientMimeType(),'video'))
                $fileName.='_movie__'; 
                if(Str::contains($file->getClientMimeType(),'image'))
                $fileName.='_image__'; 
                else
                $fileName.='_file__'; 

                $fileName.=time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}";
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                    //$file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                     $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/'.$fileName;
            }
            elseif ($req->hasFile('voice'))
            {
                $file=$req->file('voice');
                    $fileName=$req->Resiver . '_'.$req->Sender.'_voice__'.time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}"; //$file->extension()
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio'))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio');
                     $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
                     //$file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
                    $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/'.$fileName;
            }
            else
            $path='';
            $chatId=$this->getData('insertGetId',['ChatId'=>$req->ChatId,'Sender'=>$req->Sender,'Resiver'=>$req->Resiver,'Body'=>$req->Body??null,'File'=>$path,"Seen"=>(!$req->Answer)?0:1,'Parent'=>$req->Parent??null],'sendmsg',1)[0];
            
            $chatId=$this->getData('insertGetId',['ChatId'=>$req->ChatId,'Sender'=>$req->Resiver,'Resiver'=>$req->Sender,'Body'=>$req->Answer??'پیامت به دستم رسید یکم باید صبور باشی تا بررسی هام رو انجام بدم','File'=>null,"Seen"=>0,'Parent'=>$chatId],'sendmsg',1)[0];
           
            $EventController=new EventController();
        
            $EventController->ChallengeChatChange($req->ChatId);
            if($path || !$req->Answer)
            {
                $challs=(session('Challs'));
                $challs=$challs->merge((session('Histories')));
                $chall=(object)$challs->where('Id',$req->ChallId)->first();
                $EventController->PrivateMessage(" یک پیام جدید در چالش ".$chall->Title." از ".$user->FullName." دریافت شد ",$req->Resiver,'چالش های فرست کلاس',$req->ChallId);            
            }

            return response()->json(['success'=>1]);
    }
    
    public function getData($type,$param,$function,$sName=null)
    {
        if($type=="update")
        $url="http://185.116.161.39/API/updateApi_jwt.php";
        elseif($type=="updateinsert")
        $url="http://185.116.161.39/API/updateOrInserApi_jwt.php";
        elseif($type=="insertGetId")
        $url="http://185.116.161.39/API/insertGetIdApi_jwt.php";
        elseif($type=="createchat")
       	$url="http://185.116.161.39/API/CreateChat_jwt.php";
        else
        $url="http://185.116.161.39/API/selectApi_jwt.php";
        switch ($function) {
            case 'seen':
                $select="select * from ReminderTbl where UserId=".$param['uid']." and Seen=0 order By Date desc";
                $update="delete from ReminderTbl where UserId=".$param['uid']." and Link like '%".$param['link']."%' and Seen=0 ";
                break;
            case 'read':
                $select="select * from ReminderTbl where UserId=".$param['resiver']." and Seen=0 order By Date desc";
                $update="update InterviewChallMsgTbl set Seen=1 where Resiver=".$param['resiver']." and ChatId=".$param['cid']." and Seen=0 ";
                break;
            case 'chat':
                /*$select="INSERT INTO InterviewChallChatTbl (ChallUserId, Sender, Resiver) VALUES (".$param['cuid'].", ".$param['sender'].", ".$param['resiver'].")";
                $update="";*/
					$select=" SELECT Id FROM InterviewChallChatTbl  WHERE  Sender = ".$param['sender']." AND Resiver = ".$param['resiver']." AND ChallUserId = ".$param['cuid'];
            $update="INSERT INTO InterviewChallChatTbl (ChallUserId, Sender, Resiver) VALUES (".$param['cuid'].", ".$param['sender'].", ".$param['resiver'].");";

				
                break;
            case 'Readmsg':
                $select="select * from ReminderTbl where UserId=".$param['resiver']." and Seen=0 order By Date desc";
                $update="update InterviewChallMsgTbl set Seen=1 where Resiver=".$param['resiver']." and ChatId=".$param['cid']." and Seen=0 ";
                break;
            case 'msg':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Sender) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Resiver) as ResiverName
                from InterviewChallMsgTbl as ms where ChatId=".$param['cid']." and Active=1 order By Date";
                $update="update InterviewChallMsgTbl set Seen=1 where Resiver=".session('User')->Id." and ChatId=".$param['cid'];
                break;
            case 'sendmsg':
                $p=(($param['Parent'])?",Parent":"");
                $param['Parent']=(($param['Parent'])?",".$param['Parent']:"");
                $select="INSERT INTO InterviewChallMsgTbl (ChatId, Sender, Resiver,Body,[File],Seen $p) VALUES (".$param['ChatId'].", ".$param['Sender'].", ".$param['Resiver'].",N'".$param['Body']."','".($param['File']??'')."',".$param['Seen'].($param['Parent']).")";
                $update="";
                break;
            case 'Getmsg':
                $select="select ms.*,(select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Sender) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Resiver) as ResiverName from InterviewChallMsgTbl as ms where Id=".$param['cmid'];
                $update="";
                break;
            case 'setAnswer':
                $select="select * from InterviewChallUserTbl where Id=".$param['id'];
                $update="";

                if($param['correct'])
                $update="update  InterviewChallUserTbl set Status=4,Price=".$param['Price']." where Id=".$param['id'].";";
                else
                $update="update  InterviewChallUserTbl set Status=5 where Id=".$param['id'].";";

                $update.=";update InterviewChallChatTbl set Closed=1 where Id=".$param['ChatId'];
                $update.=";update InterviewChallUserTbl set Done=1 ,Answer=".$param['answer']." where Id=".$param['id'];
               
                break;
            case 'editmsg':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Sender) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Resiver) as ResiverName
                from InterviewChallMsgTbl as ms where ChatId=".$param['ChatId']." and Active=1 order By Date";
                $update="update InterviewChallMsgTbl set Updates='".$param['Updates']."', Body=N'".$param['Body']."' where Id=".$param['Id']." and ChatId=".$param['ChatId'];
                break;
            case 'delmsg':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Sender) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.Resiver) as ResiverName
                from InterviewChallMsgTbl as ms where ChatId=".$param['ChatId']." and Active=1 order By Date";
                $update="update InterviewChallMsgTbl set Active=0 where Id=".$param['Id']." and ChatId=".$param['ChatId'].";update InterviewChallMsgTbl set Parent=NULL where Parent=".$param['Id']." and ChatId=".$param['ChatId'];
                break;
            case 'automsg':
                $select="select top 1 * from InterviewChatConfigTbl where SupportId=".$param['sid']." and Active=1 ";
                $update="";
                break;
            case 'faq':
                $select="select Id,Ask,Answer from FaqTbl where Type=2 and Active=1 order By Id";
                $update="";
                break;
				
            case 'read_direct':
                $select="select * from ReminderTbl where UserId=".$param['resiver']." and Seen=0 order By Date desc";
                $update="update ChatTbl set [Read]=1 where ReceiverId=".$param['resiver']." and [Read]=0 ";
                break;
            case 'msg_direct':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.SenderId) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.ReceiverId) as ResiverName
                from ChatTbl as ms where (ReceiverId=".$param['uid']." or SenderId=".$param['uid'].") and Active=1 order By Date";
                $update="update ChatTbl set [Read]=1 where ReceiverId=".$param['uid'];
                break;
            case 'sendmsg_direct':
                $p=(($param['Parent'])?",Parent":"");
                $param['Parent']=(($param['Parent'])?",".$param['Parent']:"");
                $select="INSERT INTO ChatTbl (SenderId, ReceiverId,ExpertId,[Message],[File],[Read] $p) VALUES (".$param['Sender'].", ".$param['Resiver'].", ".$param['ExpertId'].",N'".$param['Body']."','".($param['File']??'')."',".$param['Seen'].($param['Parent']).")";
                $update="";
                break;
            case 'Getmsg_direct':
                $select="select ms.*,(select concat(u.Name,N' ',u.Family) as FullName from UserTbl as u where u.Id=ms.Sender) as SenderName,
                (select concat(u.Name,N' ',u.Family) as FullName from UserTbl as u where u.Id=ms.ReceiverId) as ResiverName from ChatTbl as ms where Id=".$param['cmid'];
                $update="";
                break;
            case 'editmsg_direct':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.SenderId) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.ReceiverId) as ResiverName
                from ChatTbl as ms where (ReceiverId=".$param['uid']." or SenderId=".$param['uid'].") and Active=1 order By Date";
                $update="update ChatTbl set  Message=N'".$param['Body']."' where Id=".$param['Id']." and SenderId=".$param['uid'];
                break;
            case 'delmsg_direct':
                $select="select ms.*,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.SenderId) as SenderName,
                (select top 1 ISNULL(u.Name,N' ')+N' '+ISNULL(u.Family,N' ') as FullName from UserTbl as u where u.Id=ms.ReceiverId) as ResiverName
                from ChatTbl as ms where (ReceiverId=".$param['uid']." or SenderId=".$param['uid'].") and Active=1 order By Date";
                $update="update ChatTbl set  Active=0 where Id=".$param['Id']." and SenderId=".$param['uid'];
                break;
            case 'MySupport':
                $select="select top 1 SellerId,SupportId from UserTbl where Id=".$param['uid'];
                $update="";
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
                if($sName!=1)
                session([$sName=>$challs]);
                else
                return $challs;
                 

            }
            return true;
    }
	

    public function Direct_index()
    {   
        $user=session('User'); 
        
        $this->getData('update',['uid'=>$user->Id,'link'=>"/message"],'seen',"Notifs"); 
       if(!session('Notifs')->count())
           session()->forget('Notifs');        

        
        $this->getData('update',['resiver'=>$user->Id],'read_direct'); 
       
        $chats=$this->getData('select',['uid'=>$user->Id],'msg_direct',1); 
        $EventController=new EventController();
        $EventController->DirectChatSeen($user->Id);
        if($user->Age<12)
        return view('panel.direct.chat_child',compact('chats','user'));
        else
        return view('panel.direct.chat',compact('chats','user'));
    }
    public function Direct_send_message(Request $req)
    {
        $user=session('User');
        if($req->hasFile('file'))
            {
                $file=$req->file('file');
                if(Str::contains($file->getClientMimeType(),'video'))
                $fileName='_movie__'; 
                elseif(Str::contains($file->getClientMimeType(),'image'))
                $fileName='_image__'; 
                else
                $fileName='_file__'; 

                $fileName.=time() ."_FCDirect.{$file->getClientOriginalExtension()}";
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Direct'))
                        mkdir('uploads/Direct');
                    if(!is_dir('uploads/Direct/user_'.$req->Sender))
                     mkdir('uploads/Direct/user_'.$req->Sender);
                    $file->move(base_path().'/../uploads/Direct/user_'.$req->Sender.'/',$fileName);
                    //$file->move(public_path().'/uploads/Direct/user_'.$req->Sender.'/',$fileName);
                     $path=route('home').'/uploads/Direct/user_'.$req->Sender.'/'.$fileName;
            }
            elseif ($req->hasFile('voice'))
            {
                $file=$req->file('voice');
                    $fileName='_voice__'.time() ."_FCDirect.{$file->getClientOriginalExtension()}"; //$file->extension()
                    if(!is_dir('uploads'))
                    mkdir('uploads');
                    if(!is_dir('uploads/Direct'))
                        mkdir('uploads/Direct');
                    if(!is_dir('uploads/Direct/user_'.$req->Sender))
                    mkdir('uploads/Direct/user_'.$req->Sender);
                    if(!is_dir('uploads/Direct/user_'.$req->Sender.'/Audio'))
                    mkdir('uploads/Direct/user_'.$req->Sender.'/Audio');
                     $file->move(base_path().'/../uploads/Direct/user_'.$req->Sender.'/Audio/',$fileName);
                     //$file->move(public_path().'/uploads/Direct/user_'.$req->Sender.'/Audio/',$fileName);
                    $path=route('home').'/uploads/Direct/user_'.$req->Sender.'/Audio/'.$fileName;
            }
            else
            $path='';
            $chat=$this->getData('insertGetId',['Sender'=>$req->Sender,'Resiver'=>$req->Resiver,'ExpertId'=>$req->SellerId,'Body'=>$req->Body??null,'File'=>$path,"Seen"=>0,'Parent'=>$req->Parent??null],'sendmsg_direct',0);
            /*$msg=(object)$this->getData('select',['cmid'=>$chatId],'Getmsg_direct',1)[0];
            $logo=asset('dist/img/Logored.png');               
            if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');*/
            $EventController=new EventController();
            $EventController->DirectChatChanges($req->Sender);
            return response()->json(['success'=>$chat]);
    }
    public function Direct_All_chat($Resiver,Request $req)
    {
        $msgs=$this->getData('select',['uid'=>$Resiver],'msg_direct',1); 
        /*$EventController=new EventController();
        $EventController->DirectChatSeen($Resiver);*/
        return response()->json(['success'=>1,'msgs'=>$msgs]);
    }
    public function Direct_edit_message(Request $req)
    {
        $this->getData('update',['Id'=>$req->Id,'Body'=>$req->Body??null,'uid'=>$req->SenderId],'editmsg_direct',0);
                  
        $EventController=new EventController();
        
        $EventController->DirectChatChanges($req->SenderId);
        return response()->json(['success'=>1]);
    }
    public function Direct_delete_message(Request $req)
    {
       $this->getData('update',['Id'=>$req->Id,'uid'=>$req->SenderId],'delmsg_direct',0);
                    
        $EventController=new EventController();
        $EventController->DirectChatChanges($req->SenderId);
        
        return response()->json(['success'=>1]);
        
       
    }
    public function Direct_read_chat($chat,Request $req)
    {
        $user=session('User'); 
        $this->getData('update',['resiver'=>$req->Resiver,'cid'=>$chat],'read'); 
       
        $this->getData('update',['uid'=>$user->Id,'link'=>"chat/".$req->Chall],'seen',"Notifs"); 
       if(!session('Notifs')->count())
           session()->forget('Notifs');       

        $EventController=new EventController();
        $EventController->ChallengeChatSeen($chat,$req->Sender);
         return response()->json(['success'=>1]);
    }

    /** SQl Server */
    public function index_SQL(InterviewChallUser $chall)
    {      
        if($chall->UserId!=auth()->user()->Id)
        abort(404);
        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        abort(404);
        /*if(!$chall->Chat()->exists() && $chall->Expired)
        {
            session()->flash('error','زمان تحویل این چالش گذشته است');
            return back();
        }*/
        
        DB::table('ReminderTbl')->where([
            'UserId'=>auth()->user()->Id,
            'Link'=>"/chat/".$chall->Id])
            ->update(['Seen'=>1]);

        if(!$chall->Chat()->exists())
        $chat=DB::table('InterviewChallChatTbl')->insertGetId(['ChallUserId'=>$chall->Id,'Sender'=>auth()->user()->Id,'Resiver'=>auth()->user()->SupportId??auth()->user()->SellerId]);
        if(!$chall->Chat->Closed)
        DB::table('InterviewChallMsgTbl')
        ->where('ChatId',$chall->Chat->Id)
        ->where('Resiver',auth()->user()->Id)
        ->where('Seen',0)
        ->update(['Seen'=>1]);
        
        $EventController=new EventController();
        $EventController->ChallengeChatSeen($chall->Chat->Id,$chall->Chat->Resiver);
        if(auth()->user()->Age<12)
        return view('panel.child.chat',compact('chall'));
        else
        return view('panel.teenager.chat',compact('chall'));
    }
    public function send_message_SQL(Request $req)
    {//dd($_FILES['voice']['error'] === UPLOAD_ERR_OK,$_FILES);
            if ($req->hasFile('file'))
            {
                $file=$req->file('file');
                $fileName=$req->Resiver . '_'.$req->Sender;
                if(Str::contains($file->getClientMimeType(),'video'))
                $fileName.='_movie__'; 
                if(Str::contains($file->getClientMimeType(),'image'))
                $fileName.='_image__'; 
                else
                $fileName.='_file__'; 

                $fileName.=time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}";
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                   $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                    // $file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                     $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/'.$fileName;
            }
            elseif ($req->hasFile('voice'))
            {
                $file=$req->file('voice');
                    $fileName=$req->Resiver . '_'.$req->Sender.'_voice__'.time() ."_FirsclassChallenge.{$file->getClientOriginalExtension()}"; //$file->extension()
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio'))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio');
                     $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                   //  $file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
                    $path=route('home').'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/'.$fileName;
            }
            else
            $path='';
            $chatId=DB::table('InterviewChallMsgTbl')->insertGetId(['ChatId'=>$req->ChatId,'Sender'=>$req->Sender,'Resiver'=>$req->Resiver,'Body'=>$req->Body??null,'File'=>$path,"Seen"=>0]);
            $msg=InterviewChallMsg::find($chatId);    
            $logo=$msg->SenderUser->Logo??asset('dist/img/Logored.png');                    
            $EventController=new EventController();
            if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');
            $EventController->ChallengeChat($req->ChatId,$chatId,$msg->Resiver,$msg->Sender,$msg->Body??null,$path,$msg->SenderUser->FullName,$msg->ResiverUser->FullName,jdate($msg->Date)->format('Y-m-d H:i:s'),$date2,jdate($msg->Date)->format('H:i:s'),$logo);
            return response()->json(['success'=>1,'chatId'=>$chatId,'Body'=>$msg->Body,'File'=>$path,'Sender'=>$msg->SenderUser->FullName,'Logo'=>$logo,'Date'=>jdate($msg->Date)->format('Y-m-d H:i:s'),'Date2'=>$date2,"Time"=>jdate($msg->Date)->format('H:i:s'),'ResiverId'=>$msg->Resiver,'SenderId'=>$msg->Sender]);
    }
    public function read_chat_SQL(InterviewChallChat $chat,Request $req)
    {
        DB::table('InterviewChallMsgTbl')->where('ChatId',$chat->Id)
        ->where('Resiver',$req->Resiver)
        ->update(['Seen'=>1]);
        
        DB::table('ReminderTbl')->where([
            'UserId'=>auth()->user()->Id,
            'Link'=>"/chat/".$chat->ChallUserId])
            ->update(['Seen'=>1]);

        $EventController=new EventController();
        $EventController->ChallengeChatSeen($chat->Id,$chat->Resiver);
         return response()->json(['success'=>1]);
    }
    public function ajaxDetailes_SQL(Request $req)
    {       
        DB::table('InterviewChallUserTbl')->where('UserId',auth()->user()->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
        $user=User::find(auth()->user()->Id);
        $challs=$user->MyChalls()->whereRaw('((cast(ExpiredAt as Date) >= cast(GETDATE() as Date) and  cast(Date as Date)  <=  cast(GETDATE() as Date)) or cast(ExpiredAt as Date) =  cast(GETDATE() as Date) )')->orderBy('ExpiredAt')->get();//$user->MyChalls()->whereRaw('(cast(ExpiredAt as Date) > GETDATE() and  DATEADD(day, ETime, cast(Date as Date))  <= GETDATE())')->orderBy('Date')->get();//$user->MyChalls()->whereRaw('cast(DATEADD(day, ETime, cast(Date as Date)) as Date) = GETDATE()')->orderBy('Date')->get();
        $out='';
        if(auth()->user()->Age<12)
            foreach($challs as $item)
            {
                $card_body = '<div class="card-body d-grid gap-1 text-center">';
                $status = '';
                if ($item->Done) {
                    $status = '<i class="fa fa-check pull-left status"></i>';
                } else {
                    $status = '<i class="fa fa-close pull-left status"></i>';
                }

                $card_body .= $status;

                if ($item->Chall->Options ?? 0) {
                    $card_body .= '<img src="' . asset('img/child/home/quiz.png') . '" class="imgicon" alt="' . $item->Chall->Type . '">';
                } elseif (in_array($item->Chall->Type ?? 'text', ['image', 'audio', 'text', 'movie'])) {
                    $card_body .= '<img src="' . asset('img/child/home/' . $item->Chall->Type . '.png') . '" class="imgicon" alt="' . $item->Chall->Type . '">';
                } else {
                    $card_body .= '<img src="' . asset('img/child/home/text.png') . '" class="imgicon" alt="' . $item->Chall->Type . '">';
                }

                $card_body .= '<b class="h6 title">' . $item->Chall->Title . '</b>';
                $card_body .= '<span class="subtitle">' . Str::limit($item->Chall->Body, 36, '...') . '</span>';

                $card_body .= '<button style="" class="btn-master fa fa-arrow-left-long pull-left m-auto" onclick="location.href=' . route('chall.details', [$item->Id]) . '"></button>';
                $card_body .= '</div>';

                $card = '<div class="card col-5 mt-2 p-md-3" onclick="location.href=' . route('chall.details', [$item->Id]) . '">' . $card_body . '</div>';


                $out.=$card;
            }
       else
            foreach($challs as $item)
            {
                $out.='<div class="card mt-2 p-md-3" onclick="location.href=\''.route('chall.details',[$item->Id]).'\'">
                        <div class="card-body">
                            <div class="row d-flex">
                                <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >';                                
                                    if($item->Chall->Options??0)                   
                                    $out.='<img src="'.asset('img/home/quiz.png').'" class="imgicon" alt="'.$item->Chall->Type.'">';
                                    elseif(in_array($item->Chall->Type??'text',['image','audio','text','movie']))                              
                                    $out.='<img src="'.asset('img/home/'.$item->Chall->Type.'.png').'" class="imgicon" alt="'.$item->Chall->Type.'">';
                                    else
                                    $out.='<img src="'.asset('img/home/text.png').'" class="imgicon" alt="'.$item->Chall->Type.'">';
                                    
                                $out.='</div>
                                <div class="col d-flex flex-column pt-0" style="border-right: 2px solid #edc587;margin-right: 16px;">
                                    <div class="" style="margin-left: -2px;margin-top: -2px;">
                                    ' . ($item->Done ? '<i class="fa fa-check pull-left status"></i>' : ($item->Expired ? '<i class="fa fa-exclamation pull-left status"></i>' : '<i class="fa fa-close pull-left status"></i>')) . '                               
                                    </div>
                                    <div class="d-flex gap-1 flex-column mx-4" style="margin-right:0.25rem!important;">                                
                                        <b class="h6 title" >' . $item->Chall->Title . '</b>
                                        <span class="subtitle">
                                        ' . Str::limit($item->Chall->Body, 36, '...') . '
                                        </span>
                                    </div> 
                                    <div class="p-0">
                                        <button style="font-size: 9pt;"  class="btn-master fa fa-arrow-left-long pull-left p-1" onclick="location.href=\'' . route('chall.details', [$item->Id]) . '\'"></button>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                    </div>';
            }
       if($out)
        $res=['success'=>1,'data'=>$out];
        else
        $res=['success'=>0];
        return response()->json($res);
        
    }
    
    public function ajaxSetAnswer_SQL(Request $req)
    { 
        $chall=InterviewChallUser::find($req->chall);
        if($chall->UserId!=auth()->user()->Id)
        return response()->json(['success'=>0,'msg'=>"چالشی پیدا نکردم"]);

        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        return response()->json(['success'=>0,'msg'=>"چالشی پیدا نکردم"]);
        if(!$chall->Chat()->exists() && $chall->Expired)
        return response()->json(['success'=>0,'msg'=>"زمان چالشت تموم شده"]);
        
        if($chall->Chat->Closed??0)
        return response()->json(['success'=>0,'msg'=>"چالشت بسته شده"]);

        if(!$chall->Chat()->exists())
        {
            $chat=DB::table('InterviewChallChatTbl')->insertGetId(['ChallUserId'=>$chall->Id,'Sender'=>auth()->user()->Id,'Resiver'=>auth()->user()->SupportId??auth()->user()->SellerId]);
            $chall=InterviewChallUser::find($req->chall);
        }
        $Body="پاسخ این سوال  ".$req->answer." است";
        if($chall->َMyAnswer==$Body)
        {
            return response()->json(['success'=>1,'msg'=>"جوابت ثبت شده بود"]);
        }
        if(!$chall->Chat->MSG()->where("Body",'like',"%$Body%")->exists())
        {
        $chatId=DB::table('InterviewChallMsgTbl')->insertGetId(['ChatId'=>$chall->Chat->Id,'Sender'=>$chall->Chat->Sender,'Resiver'=>$chall->Chat->Resiver,'Body'=>$Body,"Seen"=>0]);
        $msg=InterviewChallMsg::find($chatId);   
        }
        else
        {
            $msg=$chall->Chat->MSG()->where("Body",'like',"%$Body%")->first();
           // DB::table('InterviewChallMsgTbl')->where('Id',$msg->Id)->update(['Date'=>date('Y-m-d H:i:s')]);
            
        }
        DB::table('InterviewChallUserTbl')->where('Id',$chall->Id)->update(['Answer'=>$msg->Id]);
            $logo=$msg->SenderUser->Logo??asset('dist/img/Logored.png');                    
            $EventController=new EventController();
            if(jdate($msg->Date)->format('Y-m-d')==jdate()->format('Y-m-d'))
            $date2="امروز";
            else
            $date2=jdate($msg->Date)->format('d F');
            $EventController->ChallengeChat($chall->Chat->Id,$msg->Id,$msg->Resiver,$msg->Sender,$msg->Body??null,'',$msg->SenderUser->FullName,$msg->ResiverUser->FullName,jdate($msg->Date)->format('Y-m-d H:i:s'),$date2,jdate($msg->Date)->format('H:i:s'),$logo);

        return response()->json(['success'=>1,'msg'=>"جوابت ثبت شد"]);
    }
}
