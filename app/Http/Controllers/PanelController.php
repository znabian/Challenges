<?php

namespace App\Http\Controllers;

use App\Models\InterviewChallUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PanelController extends Controller
{
    private $api_token;
    private $childPhone;
    private $teenagerPhone;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
        // $this->childPhone=["09141189105", "09146524985", "09144195318", "09145223506", "09929104053", "09148068280", "09144901418", "09031122456", "09155024783", "09156895426", "09114231806", "09159779871", "09154015254", "09151011697", "09055397964", "09155854270", "09057396770", "09177056984", "09368899907", "09177397077", "09917573897", "09172437519", "09176564245", "09175967546", "09393818531", "09171395481", "09132457459", "09912790124", "09021148880", "09179186089", "09176136631", "09917333028", "09025625814", "09171194785", "09171839158", "09174907256", "09177027093", "09171005464", "09179186089"];
        // $this->teenagerPhone=["09144162745","09149372035","09354520031","09011652038","09142180823","09186739410","09148360176","09142180823","09908262380","09937677952","09147816843","09143147411","09143722353","09352126845","09144920762","09143533894","09143549356","09152221234","09151244332","09398904513","09057545800","09158385628","09153888826","09333048447","09156662433","09154279765","09155513530","09152328942","09166050132","09153063414","09177882253","09376135322","09173060067","09178726268","09373801945","09130698277","09331209626","09173057804","09133046428","09171029420","09339420286","09178930819"];
    }
    public function index()
    {
        $user=session('User'); 
        $user->Wallet=$this->MyWallet($user->Id)->getData()->wallet??'-';
        if($user->Perm!=3)
        $this->UpdatesChalls($user->Id,$user->CallTime);
        /*if(in_array($user->Phone,$this->childPhone) || in_array($user->Father,$this->childPhone))
        $user->seminar='child';
        elseif(in_array($user->Phone,$this->teenagerPhone) || in_array($user->Father,$this->teenagerPhone))
        $user->seminar='teenager';
        else
        $user->seminar=0;
        session(['seminar'=>$user->seminar]);*/
        $this->getData('update',['uid'=>$user->Id],'index',"Challs");        
        $challs=session('Challs');
        if($user->Age<12)
        return view('panel.child.home',compact('challs'));
        else
        return view('panel.teenager.home',compact('challs'));
    }
    public function history()
    {
        $user=session('User');
        $user->Wallet=$this->MyWallet($user->Id)->getData()->wallet??'-'; 
        if($user->Perm!=3)
        $this->UpdatesChalls($user->Id,$user->CallTime);

        /*if(in_array($user->Phone,$this->childPhone) || in_array($user->Father,$this->childPhone))
        $user->seminar='child';
        elseif(in_array($user->Phone,$this->teenagerPhone) || in_array($user->Father,$this->teenagerPhone))
        $user->seminar='teenager';
        else
        $user->seminar=0;
        session(['seminar'=>$user->seminar]);*/
        $this->getData('update',['uid'=>$user->Id],'history',"Histories");        
        $challs=session('Histories');
        
        if($user->Age<12)
        return view('panel.child.history',compact('challs'));
        else
        return view('panel.teenager.history',compact('challs'));
    }
    public function details($chall)
    {   
        $user=session('User');
        $user->Wallet=$this->MyWallet($user->Id)->getData()->wallet??'-'; 
    
        $this->getData('update',['uid'=>$user->Id,'cid'=>$chall],'details',"Chall"); 
        
        $chall=session('Chall');
        if(!$chall->count())
        abort(404);
        $chall=(object)$chall[0];
        if($chall->UserId!=$user->Id)
        abort(404);
        if(date('Y-m-d',strtotime($chall->Date))>date('Y-m-d'))
        abort(404);      
        
        if($user->Age<12)
        return view('panel.child.detailes',compact('chall'));
        else
        return view('panel.teenager.detailes',compact('chall'));
    }
    public function buyChall(Request $req)
    {   
         $user=session('User');
        $input=$req->except('day');
        if($req->expired)
        $input['expiredAt']=date_create()->modify($req->day)->format('Y-m-d H:i:s');
    
        $wallet=(object)$this->getData('select',['uid'=>$user->Id],'wallet',1)[0]; 
        
        if(($wallet->Money+100000)-$wallet->Buy>=$req->Price)
        {
            $this->getData('update',$input,'buychall'); 
            $user->Wallet=$this->MyWallet($user->Id)->getData()->wallet??'-';
            if($req->auto)
            return response()->json(['success'=>1,'msg'=>"پاداش چالشت رو دریافت کردی",'wallet'=>number_format($user->Wallet)]);
            return response()->json(['success'=>1,'msg'=>"چالش رو".number_format($req->Price)." تومان خریدی",'wallet'=>number_format($user->Wallet)]);
        }
        return response()->json(['success'=>0,'msg'=>"موجودی کیف پولت کمه"]);
        
    }
    public function MyWallet($uId)
    {   
        $wallet=(object)$this->getData('select',['uid'=>$uId],'wallet',1)[0]; 
        
        $wallet=($wallet->Money+100000)-$wallet->Buy;
        if(session('User'))
        {
            session('User')->Wallet=$wallet??'-';
            session(['User'=>session('User')]);
        }        
        return response()->json(['success'=>1,'wallet'=>$wallet,'msg'=>"موجودی کیف پولت ".number_format($wallet)." تومان است"]);
        
    }
    public function UpdatesChalls($uId,$exp)
    {   
        $lvl=date_diff(date_create(explode(' ',session('User')->CallTime)[0]),date_create(date('Y-m-d')))->format("%R%a");
        if($lvl==0)
         $lvl++;
        if($lvl)
        {
            $newchall=$this->getData('select',['uid'=>$uId,"lvl"=>$lvl],'newChalls',1);
            foreach($newchall as $chall)
            {
                $chall=(object)$chall;
                $lvl=($chall->Level)-1;                            
                $data=[
                    'UserId'=>$uId,
                    'ChallId'=>$chall->Id,
                    'ExpiredAt'=>date_create($exp)->modify("+{$lvl}day")->modify($chall->Expire)->format('Y-m-d H:i:s'),
                    'Date'=>date_create( $exp)->modify("+{$lvl}day")->format('Y-m-d H:i:s')
                ];
                $this->getData('insertGetId',$data,'InsertChalls',1);
            }
        }
        
        return 1;
    }

    public function getData($type,$param,$function,$sName=null)
    {
        if($type=="update")
        $url="http://185.116.161.39/API/updateApi_jwt.php";
        elseif($type=="insertGetId")
        $url="http://185.116.161.39/API/insertGetIdApi_jwt.php";
        else
        $url="http://185.116.161.39/API/selectApi_jwt.php";
        switch ($function) {
            case 'index':
                $select="select uc.Id,uc.Done,uc.Status,uc.Expired,uc.ExpiredAt,uc.UserId,uc.Answer,uc.Date,uc.Pay,isnull(uc.Price,0) as Money,c.Price,c.Auto,c.Expire,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body,c.Level,
                 (select top 1 cc.Closed from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as Closed , 
                 (select top 1  cc.Resiver from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatResiver,
                 (select top 1  cc.Id from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatId,
                 (select mcc.Body from InterviewChallMsgTbl as mcc inner join InterviewChallChatTbl as cc1  on cc1.Id=mcc.ChatId and cc1.Active=1 and cc1.ChallUserId=uc.Id and  mcc.Active=1 where uc.Answer=mcc.Id  ) as MyAnswer
                  From InterviewChallUserTbl as uc inner join InterviewChallTbl as c on uc.ChallId=c.Id and c.Active=1 and uc.Active=1 and  uc.UserId=".$param['uid']." where ((cast(uc.ExpiredAt as Date) >= cast(GETDATE() as Date) and  cast(uc.Date as Date)  <=  cast(GETDATE() as Date)) or cast(uc.ExpiredAt as Date) =  cast(GETDATE() as Date) ) and c.Gold=0 order By Date,c.Id,uc.ExpiredAt ";
                $update="update  InterviewChallUserTbl set Expired=1 where UserId=".$param['uid']." and Expired <> 1 and ExpiredAt <=GETDATE()";
                break;
            case 'history':
                $select="select uc.Id,uc.Done,uc.Status,uc.Expired,uc.ExpiredAt,uc.UserId,uc.Answer,uc.Date,uc.Pay,isnull(uc.Price,0) as Money,c.Price,c.Auto,c.Expire,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body,c.Level,
                 (select  top 1 cc.Closed from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1  order by cc.Id) as Closed ,
                 (select  top 1 cc.Resiver from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatResiver,
                 (select  top 1 cc.Id from InterviewChallChatTbl as cc      where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id) as ChatId,
                 (select mcc.Body from InterviewChallMsgTbl as mcc inner join InterviewChallChatTbl as cc1  on cc1.Id=mcc.ChatId and cc1.Active=1 and cc1.ChallUserId=uc.Id and  mcc.Active=1 where uc.Answer=mcc.Id  ) as MyAnswer 
                 From InterviewChallUserTbl as uc inner join InterviewChallTbl as c on uc.ChallId=c.Id and c.Active=1 and uc.Active=1 and  uc.UserId=".$param['uid']." where (Expired=1 or Done=1) and c.Gold=0 order By Date,c.Id";
                $update="update  InterviewChallUserTbl set Expired=1 where UserId=".$param['uid']." and Expired <> 1 and ExpiredAt <=GETDATE()";        
                break;
            case 'details':
                $select="select top 1 uc.Id,uc.Done,uc.Status,uc.Expired,uc.ExpiredAt,uc.UserId,uc.Answer,uc.Date,uc.Pay,isnull(uc.Price,0) as Money,c.Price,c.Auto,c.Expire,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body,c.Level, 
                (select top 1  cc.Closed from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1  order by cc.Id) as Closed ,
                (select top 1  cc.Resiver from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1 order by cc.Id ) as ChatResiver,
                (select top 1  cc.Id from InterviewChallChatTbl as cc     where cc.ChallUserId=uc.Id and cc.Active=1  order by cc.Id) as ChatId,
                (select mcc.Body from InterviewChallMsgTbl as mcc inner join InterviewChallChatTbl as cc1  on cc1.Id=mcc.ChatId and cc1.Active=1 and cc1.ChallUserId=uc.Id and  mcc.Active=1 where uc.Answer=mcc.Id  ) as MyAnswer
                 From InterviewChallUserTbl as uc inner join InterviewChallTbl as c on uc.ChallId=c.Id and c.Active=1 and uc.Active=1 and  uc.Id=".$param['cid'];
                $update="update  InterviewChallUserTbl set Status=1 where Id=".$param['cid']." and Status=0";
                break;
            case 'wallet':
                $select="SELECT sum(isnull(uc.Price,0)) as Money, sum(isnull(uc.Pay,0)) as Buy
                FROM InterviewChallUserTbl as uc 
                join InterviewChallTbl as c on c.Id=uc.ChallId and uc.UserId=".$param['uid']." and c.Active=1 and uc.Active=1
                where isnull(uc.Pay,0)<>0";
                $update="";
                break;
            case 'buychall':
                $select="select top 1 uc.Id,uc.Done,uc.Expired,uc.ExpiredAt,uc.UserId,uc.Answer,uc.Date,uc.Pay,isnull(uc.Price,0) as Money,c.Price,c.Expire,c.[File],c.[Link],c.Options,c.Type,c.Title,c.Body, (select cc.Closed from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1) as Closed ,(select cc.Resiver from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1) as ChatResiver,(select cc.Id from InterviewChallChatTbl as cc where cc.ChallUserId=uc.Id and cc.Active=1) as ChatId,(select mcc.Body from InterviewChallMsgTbl as mcc inner join InterviewChallChatTbl as cc1  on cc1.Id=mcc.ChatId and cc1.Active=1 and cc1.ChallUserId=uc.Id and  mcc.Active=1 where uc.Answer=mcc.Id  ) as MyAnswer From InterviewChallUserTbl as uc inner join InterviewChallTbl as c on uc.ChallId=c.Id and c.Active=1 and uc.Active=1 and  uc.Id=".$param['chall'];
                if($param['auto'])
                $w=",Price=60000,Done=1";
                else
                $w='';
                $update="update  InterviewChallUserTbl set Pay=".$param['Price'].$w.",PayDate=GETDATE(),ExpiredAt='".$param['expiredAt']."',Expired=0 where Id=".$param['chall']." ";
                break;
            case 'newChalls':
                $select="SELECT c.Id,c.Level,c.Expire FROM InterviewChallTbl as c
                where Level<=".$param['lvl']." 
                and not exists(select Id from InterviewChallUserTbl as uc where uc.ChallId=c.Id and uc.UserId=".$param['uid']." and uc.Active=1)
                and c.Active=1 and c.Gold=0";
                $update="";
                break;
            case 'InsertChalls':
                $select="INSERT INTO InterviewChallUserTbl (ChallId, UserId,ExpiredAt,Expired,Done,[Date]) VALUES (".$param['ChallId'].", ".$param['UserId'].", '".$param['ExpiredAt']."',0,0,'".$param['Date']."')";
                $update="";
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
            ])->asForm()->post($url,['update' => $update,'data' => $select]);
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
    /** SQl Server */
    public function index_SQL()
    {
        DB::table('InterviewChallUserTbl')->where('UserId',auth()->user()->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
        $user=User::find(auth()->user()->Id);
        $challs=$user->MyChalls()->whereRaw('((cast(ExpiredAt as Date) >= cast(GETDATE() as Date) and  cast(Date as Date)  <=  cast(GETDATE() as Date)) or cast(ExpiredAt as Date) =  cast(GETDATE() as Date) )')->orderBy('ExpiredAt')->get();//$user->MyChalls()->whereRaw('(cast(ExpiredAt as Date) > GETDATE() and  DATEADD(day, ETime, cast(Date as Date))  <= GETDATE())')->orderBy('Date')->get();//$user->MyChalls()->whereRaw('cast(DATEADD(day, ETime, cast(Date as Date)) as Date) = GETDATE()')->orderBy('Date')->get();
        if(auth()->user()->Age<12)
        return view('panel.child.home',compact('challs'));
        else
        return view('panel.teenager.home',compact('challs'));
    }
    public function history_SQL()
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
    public function details_SQL(InterviewChallUser $chall)
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
