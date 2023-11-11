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
        if(auth()->user()->Age<12)
        return view('panel.child.chat',compact('chall'));
        else
        return view('panel.teenager.chat',compact('chall'));
    }
    public function send_message(Request $req)
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
                   // $file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                    $file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
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
                     //$file->move(base_path().'/../uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/',$fileName);
                     $file->move(public_path().'/uploads/Chat/'.$req->ChallId.'/'.$req->ChatId.'/Audio/',$fileName);
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
    
    public function ajaxSetAnswer(Request $req)
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
