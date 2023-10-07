<?php

namespace App\Http\Controllers;

use App\Models\InterviewChallChat;
use App\Models\InterviewChallMsg;
use App\Models\InterviewChallUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function index(InterviewChallUser $chall)
    {      
        if($chall->UserId!=auth()->user()->Id)
        abort(404);
        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        abort(404);
        if(!$chall->Chat()->exists() && $chall->Expired)
        {
            session()->flash('error','زمان تحویل این چالش گذشته است');
            return back();
        }
        
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

        return view('panel.chat',compact('chall'));
    }
    public function send_message(Request $req)
    {
            if ($req->hasFile('file'))
             {
                $file=$req->file('file');
                    $fileName=$req->Resiver . '_'.$req->Sender.'_'.time() ."_FirsclassChallenge.{$file->extension()}"; 
                    if(!is_dir('uploads'))
                        mkdir('uploads');
                    if(!is_dir('uploads/Chat'))
                        mkdir('uploads/Chat');
                    if(!is_dir('uploads/Chat/'.$req->ChallId))
                     mkdir('uploads/Chat/'.$req->ChallId);
                    if(!is_dir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId))
                     mkdir('uploads/Chat/'.$req->ChallId.'/'.$req->ChatId);
                    $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
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
            return response()->json(['success'=>1,'Body'=>$msg->Body,'File'=>$path,'Sender'=>$msg->SenderUser->FullName,'Logo'=>$logo,'Date'=>jdate($msg->Date)->format('Y-m-d H:i:s'),'Date2'=>$date2,"Time"=>jdate($msg->Date)->format('H:i:s'),'ResiverId'=>$msg->Resiver,'SenderId'=>$msg->Sender]);
    }
    public function read_chat(InterviewChallChat $chat,Request $req)
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
    public function ajaxDetailes(Request $req)
    {       
        DB::table('InterviewChallUserTbl')->where('UserId',auth()->user()->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
        $user=User::find(auth()->user()->Id);
        $challs=$user->MyChalls()->whereRaw('((cast(ExpiredAt as Date) >= cast(GETDATE() as Date) and  cast(Date as Date)  <=  cast(GETDATE() as Date)) or cast(ExpiredAt as Date) =  cast(GETDATE() as Date) )')->orderBy('ExpiredAt')->get();//$user->MyChalls()->whereRaw('(cast(ExpiredAt as Date) > GETDATE() and  DATEADD(day, ETime, cast(Date as Date))  <= GETDATE())')->orderBy('Date')->get();//$user->MyChalls()->whereRaw('cast(DATEADD(day, ETime, cast(Date as Date)) as Date) = GETDATE()')->orderBy('Date')->get();
        $out='';
       foreach($challs as $item)
       {
        $out.='
        <div class="card mt-2 p-md-3">
            <div class="card-body">
                <div class="row d-flex">
                    <div class="col-1 m-auto">
                        <span class="circle">' . $item->Chall->Level . '</span>
                    </div>
                    <div class="col d-flex flex-column pt-0">
                        <div style="margin-left: -2px;margin-top: -2px;">
                            ' . ($item->Done ? '<i class="fa fa-check pull-left status"></i>' : ($item->Expired ? '<i class="fa fa-exclamation pull-left status"></i>' : '<i class="fa fa-close pull-left status"></i>')) . '
                        </div>
                        <div class="d-flex gap-1 flex-column mx-4">
                            <b class="h6" style="font-size: 15pt;">
                                ' . $item->Chall->Title . '
                            </b>
                            <span style="font-family:Peyda;font-size: 8pt;font-weight: 100;">
                                ' . Str::limit($item->Chall->Body, 47, '...') . '
                            </span>
                        </div>
                        <div class="p-0">
                            <button class="btn-master fa fa-arrow-left-long p-1 pull-left" onclick="location.href=\'' . route('chall.details', [$item->Id]) . '\'"></button>
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
    
}
