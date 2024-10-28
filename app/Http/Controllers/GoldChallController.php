<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GoldChallController extends Controller
{
    private $api_token;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
    }
    public function reset(Request $req)
    {
        $user=session('User');
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        
        if($mysubject->count())
        {
            $mysubject=$mysubject->first();
            $data= json_decode($mysubject['Other']??'[]');
            $data[]=['SubjectId'=>$mysubject['SubjectId'],'Description'=>$mysubject['Description']];
            $other=json_encode( $data);
            $mysubject=$this->functions('update',['uid'=>$user->Id,'other'=>$other],'ReSubject',1);
            return redirect(route('gold.landing'));
        }
        abort(404);
        
    }
    public function landing(Request $req)
    {
        $user=session('User');
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if($mysubject->count())
            return redirect(route('gold.chall'));
        
            if($user->Age<12)
            return view('panel.child.gold.index');
            else
            return view('panel.teenager.gold.index');
        
    }
    public function mySupervisor(Request $req)
    {
        $user=session('User');   
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if($mysubject->count())
            return redirect(route('gold.chall'));         
        $mysubject=$this->functions('select',['UserId'=>$user->Id],'mySupervisor',1);
        
        if($mysubject->count())
        $mysubject=json_decode($mysubject[0]['Supervisor'],1);
        
        if($user->Age<12)
        return view('panel.child.gold.supervisor',compact('mysubject'));
        else
        return view('panel.teenager.gold.supervisor',compact('mysubject'));
        
    }
    public function setSupervisor(Request $req)
    {
        $user=session('User');
        $data=['UserId'=>$user->Id,'Supervisor'=>json_encode($req->except('_token'))];
        

        $subject=$this->functions('updateinsert',$data,'selectsupervisor');
        if($subject)
           return redirect(route('gold.index'));
        session()->flash('error','ثبت اطلاعات با مشکل مواجه شد');
        return back()->withInput();
        
       
    }
    public function index(Request $req)
    {
        $user=session('User');
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        
        if($mysubject->count() && $user->Perm!=3)
            return redirect(route('gold.chall'));
        
            $castles=$this->functions('select',[],'castle','castles');
            
            if($user->Age<12)
            return view('panel.child.gold.castle',compact('castles'));
            else
            return view('panel.teenager.gold.castle',compact('castles'));
        
    }
    public function AppHeader($castle,Request $req)
    {
        $user=session('User');

        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if($mysubject->count() && $user->Perm!=3)
            return redirect(route('gold.chall'));
        
        $headers=$this->functions('select',['aid'=>$castle],'header',1);
        if(!$headers->count())
        abort(404);
        $app=$headers->first();
        if($user->Age<12)
        return view('panel.child.gold.header',compact('headers','app'));
        else
        return view('panel.teenager.gold.header',compact('headers','app'));
    }
    public function HeaderSubject($header,Request $req)
    {
        $user=session('User');

        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if($mysubject->count() && $user->Perm!=3)
            return redirect(route('gold.chall'));

        $subjects=$this->functions('select',['hid'=>$header],'subject',1);
        if(!$subjects->count())
        abort(404);
        $app=$subjects->first();
        if($user->Age<12)
        return view('panel.child.gold.subject',compact('subjects','app','mysubject','user'));
        else
        return view('panel.teenager.gold.subject',compact('subjects','app','mysubject','user'));
    }
    public function SelectSubject(Request $req)
    {
        $user=session('User');
        if(!$req->subject)
        return response('',500);

        $subject=$this->functions('updateinsert',['uid'=>$user->Id,'sid'=>$req->subject],'selectsubject');
        if($subject)
        {
            $subjects=$this->functions('update',['sid'=>$req->subject],'updatesubject');       
            return response()->json(['success'=>1,'msg'=>$user->FullName." موضوع انتخابیت با موفقیت رزرو شد <br> بعد از تایید موضوع توسط آقای خوش نظر میتونی چالش طلایی رو ادامه بدی"]);
        
        }
         return response('',500);
        
       
    }
    public function GoldChall(Request $req)
    {
        $user=session('User');
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if(!$mysubject->count())
            return redirect(route('gold.landing'));
        $subject=$mysubject->first();
        $videos=$this->functions('select',['uid'=>$user->Id],'videos',1);
        /*if($subject['Confirm']>0)
        $challs=$this->functions('select',['uid'=>$user->Id],'challs',1);
        else
        $challs=Collection::make([]);*/
         if($user->Age<12)
        return response()->view('panel.child.gold.challs',compact('subject','videos'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
        else
        return response()->view('panel.teenager.gold.challs',compact('subject','videos'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
       
    }
    public function PlayVideo($vid,Request $req)
    {
        $user=session('User');
        $mysubject=$this->functions('select',['uid'=>$user->Id],'mySubject',1);
        if(!$mysubject->count())
            return redirect(route('gold.landing'));
        $subject=$mysubject->first();
        if(($subject['Confirm']??0)!=1)
            return redirect(route('gold.chall'));
        
        $this->functions('updateinsert',['cid'=>$vid,'uid'=>$user->Id],'newchall');
        $mychall=$this->functions('update',['cid'=>$vid,'uid'=>$user->Id],'mychall',1)->first();
        
        $video=$this->functions('select',['vid'=>$vid,'uid'=>$user->Id],'showvideo',1)->first();
        
         if($user->Age<12)
        return view('panel.child.gold.play',compact('video','mychall'));
        else
        return view('panel.teenager.gold.play',compact('mychall','video'));
       
    }
    public function ChallDone(Request $req)
    {
        $user=session('User');
        
       $done= $this->functions('update',['cid'=>$req->cid,'uid'=>$user->Id],'donechall',1);
      
       return response()->json(['status'=>$done]);
       
    }
    public function setPage(Request $req)
    {
        $user=session('User');
        if(trim($req->Page))
       $done= $this->functions('update',['sid'=>$req->sid,'uid'=>$user->Id,'page'=>trim($req->Page)],'setPageChall',1);
      else
      $done=0;
       return response()->json(['status'=>$done]);
       
    }
    public function reset_platform(Request $req)
    {
        $user=session('User');
       $done= $this->functions('update',['sid'=>$req->sid,'uid'=>$user->Id],'resetPlatform',1);     
       return response()->json(['status'=>$done]);
       
    }
    public function functions($type,$param,$function,$sName=null)
    {
        if($type=="update")
        $url="http://185.116.161.39/API/updateApi_jwt.php";
        elseif($type=="insertGetId")
        $url="http://185.116.161.39/API/insertGetIdApi_jwt.php";
        elseif($type=="updateinsert")
        $url="http://185.116.161.39/API/updateOrInserApi_jwt.php";
        else
        $url="http://185.116.161.39/API/selectApi_jwt.php";
        switch ($function) {
            case 'castle':
                $select="select AppId,Castle, (select Logo from AppTbl where AppTbl.Id=AppId) Logo
                        FROM GoldChallHeaderTbl where Active=1 Group By AppId,Castle";
                $update="";
                break;
            case 'header':
                $select="select *, (select Logo from AppTbl where AppTbl.Id=AppId) Logo FROM GoldChallHeaderTbl where Active=1 and AppId=".$param['aid'];
                $update="";
                break;
            case 'subject':
                $select="select *,
                (select Title from GoldChallHeaderTbl where GoldChallHeaderTbl.id=HeaderId) Header,
                (select Castle from GoldChallHeaderTbl where GoldChallHeaderTbl.id=HeaderId) Castle,
                (select AppId from GoldChallHeaderTbl where GoldChallHeaderTbl.id=HeaderId) AppId
                FROM GoldChallSubjectTbl  where Active=1 and HeaderId=".$param['hid'];
                $update="";        
                break;
            case 'subjects':
                $select="select *,
                (select Title from GoldChallHeaderTbl where GoldChallHeaderTbl.id=HeaderId) Header,
                (select Castle from GoldChallHeaderTbl where GoldChallHeaderTbl.id=HeaderId) Castle
                FROM GoldChallSubjectTbl  where Active=1";
                $update="";        
                break;
            case 'selectsubject':
                $select="select Id from GoldChallSelectTbl where UserId=".$param['uid'];//." and SubjectId=".$param['sid'];
                $update="update GoldChallSelectTbl set Active=1,Confirm=NULL,SubjectId=".$param['sid']." where Id=?";
                $insert="INSERT INTO GoldChallSelectTbl (UserId, SubjectId) VALUES (".$param['uid'].", ".$param['sid'].")";
                break;
            case 'selectsupervisor':
                $select="select Id from GoldChallSelectTbl where UserId=".$param['UserId'];//." and SubjectId=".$param['sid'];
                $update="update GoldChallSelectTbl set Active=0,Confirm=NULL,SubjectId=NULL,Supervisor='".$param['Supervisor']."' where Id=?";
                $insert="INSERT INTO GoldChallSelectTbl (UserId, Supervisor,Active) VALUES (".$param['UserId'].", '".$param['Supervisor']."',0)";
                
                break;
            case 'mySupervisor':
                $select="select Id,Supervisor from GoldChallSelectTbl where UserId=".$param['UserId'];//." and SubjectId=".$param['sid'];
                $update="";
                
                break;
            case 'updatesubject':
                $select="select Id from GoldChallSubjectTbl where Id=".$param['sid'];//." and SubjectId=".$param['sid'];
                $update="update GoldChallSubjectTbl set Register=Register+1 where Id=".$param['sid'];
                break;
            case 'mySubject':
                if(isset($param['confirm']))
                $conf=" and isnull(Confirm,0)=".$param['confirm'];
                else
                $conf="";

                $select="select *,(select Title from GoldChallSubjectTbl as s where s.Id=ss.SubjectId) Subject
                        from GoldChallSelectTbl ss where Active=1 and UserId=".$param['uid'].$conf;
                $update="";
                break;
            case 'ReSubject':
                $select="select *,(select Title from GoldChallSubjectTbl as s where s.Id=ss.SubjectId) Subject
                        from GoldChallSelectTbl ss where Active=1 and UserId=".$param['uid'];
                $update="update GoldChallSelectTbl set Confirm=NULL,ConfirmDate=NULL,Page=NULL,Platform=NULL,Description=NULL,Active=0,Other='".$param['other']."' where Active=1 and UserId=".$param['uid'];
                break;
            case 'challs':
                $select="select uc.Id,uc.Done,uc.Status,uc.UserId,uc.Answer,uc.Date,uc.Pay,isnull(uc.Price,0) as Money,c.Price,c.Auto,c.[File],c.[Link],c.[Logo],c.Options,c.Type,c.Title,c.Body,c.Level,
                    (select top 1 cc.Closed from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as Closed , 
                    (select top 1  cc.Resiver from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatResiver,
                    (select top 1  cc.Id from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatId,
                    (select mcc.Body from InterviewChallMsgTbl as mcc inner join InterviewChallChatTbl as cc1  on cc1.Id=mcc.ChatId and cc1.Active=1 and cc1.ChallUserId=uc.Id and  mcc.Active=1 where uc.Answer=mcc.Id  ) as MyAnswer
                    From InterviewChallUserTbl as uc inner join InterviewChallTbl as c on uc.ChallId=c.Id and c.Active=1 and uc.Active=1 and  uc.UserId=".$param['uid']." and c.Gold=1   order By Date,c.Id ";//c.Active=1
                $update="";
                
                break;
            case 'videos':
                $select="select (select count(cu.id) from InterviewChallUserTbl as cu where cu.ChallId=c.Id and cu.Active=1 and cu.Done=1 and cu.UserId=".$param['uid'].") as unlock, c.Id,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body,c.Level,c.Logo From InterviewChallTbl as c where c.Active=1 and c.Gold=1 order By Level,c.Id ";//c.Active=1
                $update="";                
                break;
            case 'showvideo':
                $select="select (select count(cu.id) from InterviewChallUserTbl as cu where cu.ChallId=c.Id and cu.Active=1 and cu.Done=1 and cu.UserId=".$param['uid'].") as unlock, c.Id,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body,c.Level,c.Logo From InterviewChallTbl as c where c.Active=1 and c.Gold=1 and c.Id =".$param['vid'];//c.Active=1
                $update="";                
                break;
            
            case 'newchall':
                $select="select Id from InterviewChallUserTbl where Active=1 and UserId=".$param['uid']." and ChallId=".$param['cid'];
                $update="update InterviewChallUserTbl set Active=1  where Id=?";
                $insert="INSERT INTO InterviewChallUserTbl (ChallId, UserId,Expired,Done,[Date]) VALUES (".$param['cid'].", ".$param['uid'].", 0,0,'".date('Y-m-d H:i:s')."')";
                break;
            case 'mychall':
                $select="select * from InterviewChallUserTbl where Active=1 and UserId=".$param['uid']." and ChallId=".$param['cid'];
                $update="update GoldChallSelectTbl set Platform=(select top 1 Logo from InterviewChallTbl where Id=".$param['cid'].") where UserId=".$param['uid']." and Confirm=1 and Active=1";
                break;
            case 'donechall':
                $select="select Done from InterviewChallUserTbl where Id=".$param['cid'];
                $update="update InterviewChallUserTbl set Done=1,PayDate=GETDATE() where Id=".$param['cid'];
                break;
            case 'setPageChall':
                $select="select Page from GoldChallSelectTbl where Id=".$param['sid'];
                $update="update GoldChallSelectTbl set Page='".$param['page']."' where Active=1 and Confirm=1 and Id=".$param['sid']." and UserId=".$param['uid'];
                break;
            case 'resetPlatform':
                $select="select Platform from GoldChallSelectTbl where Id=".$param['sid'];
                $update="update GoldChallSelectTbl set Platform=NULL where Active=1 and Confirm=1 and Id=".$param['sid']." and UserId=".$param['uid'];
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

                return $challs;
                 

            }
            return $response->ok();
    }
}
