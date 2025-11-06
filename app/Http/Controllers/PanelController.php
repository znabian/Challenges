<?php

namespace App\Http\Controllers;

use App\Models\InterviewChallUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PanelController extends Controller
{
    private $api_token;
    private $childPhone;
    private $teenagerPhone;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
         $this->childPhone=["09141189105", "09146524985", "09144195318", "09145223506", "09929104053", "09148068280", "09144901418", "09031122456", "09155024783", "09156895426", "09114231806", "09159779871", "09154015254", "09151011697", "09055397964", "09155854270", "09057396770", "09177056984", "09368899907", "09177397077", "09917573897", "09172437519", "09176564245", "09175967546", "09393818531", "09171395481", "09132457459", "09912790124", "09021148880", "09179186089", "09176136631", "09917333028", "09025625814", "09171194785", "09171839158", "09174907256", "09177027093", "09171005464", "09179186089"];
         $this->teenagerPhone=["09144162745","09149372035","09354520031","09011652038","09142180823","09186739410","09148360176","09142180823","09908262380","09937677952","09147816843","09143147411","09143722353","09352126845","09144920762","09143533894","09143549356","09152221234","09151244332","09398904513","09057545800","09158385628","09153888826","09333048447","09156662433","09154279765","09155513530","09152328942","09166050132","09153063414","09177882253","09376135322","09173060067","09178726268","09373801945","09130698277","09331209626","09173057804","09133046428","09171029420","09339420286","09178930819"];
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
        session(['seminar2'=>$user->seminar]);*/

        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }
        

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
        session(['seminar2'=>$user->seminar]);*/

        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }

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
        elseif($type=="updateinsert")
        $url="http://185.116.161.39/API/updateOrInserApi_jwt.php";
        elseif($type=="insertselect")
        $url="http://185.116.161.39/API/InsertSelectApi_jwt.php";
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
            case 'AbstractFile':
                $select="select *,(select top 1 Fullcount from ViewTbl as v where v.CId=AppTbl.Id and v.AId=AppTbl.Parent and  v.type='FirstClass' and v.UserId=".$param['uid'].") as Seen from AppTbl where Active=1 and Parent=1740 Order By Meta,Sort";
                $update="";
                break;
            case 'MyFCType':
                    $select="select AppId,WorkTime,GroupId from PaymentTbl where Active=1 and AppId in(38,39,40,41,51,52) and UserId=".$param['uid'];
                    $update="";
                    break;
            case 'MyRank':
                $select="select * from (select Id,Phone, concat(Name,' ',Family) as FullName,(SELECT TOP (1) Province
                       FROM UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id)) AS Province,                      
                        [Perm],BirthDay,CallTime, 
                        isnull((SELECT count(uc.Pay)
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 and uc.Done=1
                            ),0) AS Challs,isnull((SELECT (sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            ),100000) as wallet,
                            DENSE_RANK ( ) OVER ( order By (
                            (SELECT isnull((sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)),100000) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            ) ) 
                        desc)  rank from UserTbl as A where (Active > 0) AND CallTime is not NULL AND (ISNULL(Cancel, 0) = 0) 
	                    AND EXISTS(select * from PaymentTbl where UserId=A.Id and PaymentTbl.Active=1 and AppId in(".$param['apps']."))
					    and Perm in (0,2)) as r where r.Id=".$param['uid'];
                        
                $update="";
                break;

            case 'MyCityRank':
                $select="select * from (select Id,Phone, concat(Name,' ',Family) as FullName,(SELECT TOP (1) Province
                       FROM UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id)) AS Province,                      
                        [Perm],BirthDay,CallTime, 
                        isnull((SELECT count(uc.Pay)
                        FROM InterviewChallUserTbl as uc 
                        join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                        where isnull(uc.Pay,0)<>0 and uc.Done=1
                        ),0) AS Challs,isnull((SELECT (sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)) as Buy
                        FROM InterviewChallUserTbl as uc 
                        join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                        where isnull(uc.Pay,0)<>0 
                        ),100000) as wallet,
                        DENSE_RANK ( ) OVER ( order By (
                            (SELECT isnull((sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)),100000) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            and exists(SELECT TOP (1) Province
                       FROM      UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id) and Province like N'%".$param['city']."%')
                            ) ) 
                        desc)  rank from UserTbl as A where (Active > 0) AND CallTime is not NULL AND (ISNULL(Cancel, 0) = 0) 
	                    AND EXISTS(select * from PaymentTbl where UserId=A.Id and PaymentTbl.Active=1 and AppId in(".$param['apps']."))
					    and Perm in (0,2) and exists(SELECT TOP (1) Province
                       FROM      UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id) and Province like N'%".$param['city']."%')) as r where r.Id=".$param['uid'];
                        
                $update="";
                break;

            case 'AllRank':
                $select="select top 20 Id,Phone, concat(Name,' ',Family) as FullName,(SELECT TOP (1) Province
                       FROM UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id)) AS Province,                      
                        [Perm],BirthDay,CallTime, 
                        isnull((SELECT count(uc.Pay)
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 and uc.Done=1
                            ),0) AS Challs,isnull((SELECT (sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            ),100000) as wallet,
                            DENSE_RANK ( ) OVER ( order By (
                            (SELECT isnull((sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)),100000) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            ) ) 
                        desc)  rank from UserTbl as A where (Active > 0) AND CallTime is not NULL AND (ISNULL(Cancel, 0) = 0) 
	                    AND EXISTS(select * from PaymentTbl where UserId=A.Id and PaymentTbl.Active=1 and AppId in(".$param['apps']."))
					    and Perm in (0,2)";
                        
                $update="";
                break;
            case 'CityRank':
                $select="select top 20 Id,Phone, concat(Name,' ',Family) as FullName,(SELECT TOP (1) Province
                       FROM UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id)) AS Province,                      
                        [Perm],BirthDay,CallTime, 
                        isnull((SELECT count(uc.Pay)
                        FROM InterviewChallUserTbl as uc 
                        join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                        where isnull(uc.Pay,0)<>0 and uc.Done=1
                        ),0) AS Challs,isnull((SELECT (sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)) as Buy
                        FROM InterviewChallUserTbl as uc 
                        join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                        where isnull(uc.Pay,0)<>0 
                        ),100000) as wallet,
                        DENSE_RANK ( ) OVER ( order By (
                            (SELECT isnull((sum(isnull(uc.Price,0))+100000) - sum(isnull(uc.Pay,0)),100000) as Buy
                            FROM InterviewChallUserTbl as uc 
                            join InterviewChallTbl as c on c.Id=uc.ChallId and c.Active=1 and uc.UserId=A.Id and uc.Active=1
                            where isnull(uc.Pay,0)<>0 
                            and exists(SELECT TOP (1) Province
                       FROM      UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id) and Province like N'%".$param['city']."%')
                            ) ) 
                        desc)  rank from UserTbl as A where (Active > 0) AND CallTime is not NULL AND (ISNULL(Cancel, 0) = 0) 
	                    AND EXISTS(select * from PaymentTbl where UserId=A.Id and PaymentTbl.Active=1 and AppId in(".$param['apps']."))
					    and Perm in (0,2) and exists(SELECT TOP (1) Province
                       FROM      UserDetailsTbl
                       WHERE   (DetailId=UserDetailsTbl.Id) and Province like N'%".$param['city']."%')";
                $update="";
                break;
                case 'capacity':
                    $select="select count(Date) cdate,cast(Date as date) as Date,Type from ReservationTbl where City=N'".$param['city']."' ".($param['where']??'')." and [Type] in (3,4,8,7)  and Status=0 and Active=1 group By cast(Date as date),Type ";
                    $update="update ReservationTbl set Status=1 where [Type] in (3,4,8,7) and Status=0 and Active=1 and cast(Date as date)<cast(GETDATE() as date)";
                    break;
                case 'MyReserve':
                    $select="select *,cast(Date as date) dday from ReservationTbl where UserId=".$param['uid']." and City=N'".$param['city']."' and [Type] in (3,4,8,7) and Active=1  order By  Status ,Date ";
                    $update="";
                    break;
                case 'MyReserveAllow':
                    $select="select isnull(cast(SUM(DATEDIFF(MINUTE, starttime, endtime)) / 60  as int),0) AS totalhours  from ReservationTbl where UserId=".$param['uid']." and City=N'".$param['city']."'  and [Type] in (3,4,8,7) and Active=1 and Status not in (2,4,5) ";
                    $update="";
                    break;
                case 'Reservation':
                        $select="select  *  from ReservationTbl where UserId=".$param['uid']." and cast(Date as date)='".$param['date']."' and Active=1 and Status in(0,4) and City=N'".$param['city']."'  and [Type]=".$param['type'];
                        $update="update ReservationTbl set Active=1,Status=0,Description=NULL,Works=NULL,[SMS]=0 where Id=?";
                        $insert="INSERT INTO ReservationTbl (UserId, [Date],[Type],City,[StartTime],[EndTime],AppId) VALUES (".$param['uid'].", '".$param['date']."','".$param['type']."',N'".$param['city']."','".$param['start']."','".$param['end']."',".$param['appid'].")";
                       
                    break;
                case 'CancelReservation':
                        $select="select  *  from ReservationTbl where UserId=".$param['uid']." and Active=1 and City=N'".$param['city']."'  and [Type] in(3,4,8,7)";
                        $update="update ReservationTbl set Status=4 where Id=".$param['rid'];
                        $insert="";
                        
                    break;
            case 'DaysReservation':
                    $select="select  *  from BCReserveDayTbl where Platform='FC' and Active=1 and City like N'%".$param['city']."%'  and [Type] in(3,4,8,7)";
                    $update="";
                    $insert="";
                    
                break;
                case 'CancelDays':
                        $select="select count(Date) cdate,cast(Date as date) as Date,Type from ReservationTbl where City=N'".$param['city']."' ".($param['where']??'')." and [Type] in (3,4,8,7) and Status=5 and Active=1 group By cast(Date as date),Type ";
                        $update="";
                        break;
            case 'ReservationAlert':
                    $select="INSERT INTO AlarmTbl (SenderId,UserId, Active, SupportId,Description,Type,[Date]) VALUES (8,".$param['uid'].", 1, ".$param['sid'].",N'".$param['des']."',".$param['type'].",GETDATE())";
                    $update="";                    
                break;
            default:
                # code...
                break;
        }
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',           
                'api_token' => $this->api_token,
            ])->asForm()->post($url,['update' => $update,'data' => $select,'insert' => $insert??'']);
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
    function MyRank(Request $req)
    {
        $fc1=[38,39,40,41];
        $fc2=[51,52];
        $user=session('User');  
        if(!($user->FisrtClass??0))
        {   
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }      
           
        if($user->FisrtClass==1)
        {
            $ranks=$this->getData('select',['apps'=>implode(',',$fc1)],'AllRank',1); 
            if(!$ranks->count())
            abort(404);
            $myRank=(object)$this->getData('select',['apps'=>implode(',',$fc1),'uid'=>$user->Id],'MyRank',1)->first();
            $mycity=$myRank->Province??'0';
            if($mycity)
            $Cityranks=$this->getData('select',['city'=>$mycity,'apps'=>implode(',',$fc1)],'CityRank',1); 
            else
            $Cityranks=$ranks;
            $myRankCity=(object)$this->getData('select',['city'=>$mycity,'apps'=>implode(',',$fc1),'uid'=>$user->Id],'MyCityRank',1)->first();
        }
        else
        {
            $ranks=$this->getData('select',['apps'=>implode(',',$fc2)],'AllRank',1);  
            if(!$ranks->count())
            abort(404);
            $myRank=(object)$this->getData('select',['apps'=>implode(',',$fc2),'uid'=>$user->Id],'MyRank',1)->first();
            $mycity=$myRank->Province??'0';
            if($mycity)
            $Cityranks=$this->getData('select',['city'=>$mycity,'apps'=>implode(',',$fc2)],'CityRank',1); 
            else
            $Cityranks=$ranks;
            $myRankCity=(object)$this->getData('select',['city'=>$mycity,'apps'=>implode(',',$fc2),'uid'=>$user->Id],'MyCityRank',1)->first();

        }
        if($user->Age<12)
        return view('panel.child.rank',compact('myRank','ranks','Cityranks','myRankCity','mycity','user'));
        else
        return view('panel.teenager.rank',compact('myRank','ranks','Cityranks','myRankCity','mycity','user'));
    }
    function abstractList(Request $req)
    {
        $user=session('User');  
        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }
        if($user->FisrtClass==2)
        abort(403);
        $headers=Collection::make($this->getData('select',['uid'=>$user->Id],'AbstractFile',1)); 
        /*$headers=[
            [['Id'=>"1-12",'Title'=>"یک تا دوازده",'File'=>"https://kakheroshd.ir:448/RedCastleFileManager/first-class/abstarct/1-12.mp4"]]
        ];*/
        if($user->Age<12)
        return response()->view('panel.child.abstarct',compact('headers'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
        else
        return response()->view('panel.teenager.abstarct',compact('headers'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
    }
    function abstractShow($id,Request $req)
    {
        $user=session('User');
        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }
        if($user->FisrtClass==2)
        abort(403);
        $headers=Collection::make($this->getData('select',['uid'=>$user->Id],'AbstractFile',1));   
       /* $headers=[
            "1-12"=>['Title'=>"نکات یک تا دوازده",'File'=>"https://kakheroshd.ir:448/RedCastleFileManager/first-class/abstarct/1-12.mp4"]
        ];*/
        $video=$headers->where('Id',$id)->first();
        return view('panel.teenager.abstarctplay',compact('video'));
    }

    function OfflineList(Request $req)
    {
        $user=session('User');  
        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }
        if($user->FisrtClass==1)
        abort(403);
        $headers=Collection::make($this->getData('select',['uid'=>$user->Id],'AbstractFile',1)); 
        /*$headers=[
            [['Id'=>"1-12",'Title'=>"یک تا دوازده",'File'=>"https://kakheroshd.ir:448/RedCastleFileManager/first-class/abstarct/1-12.mp4"]]
        ];*/
        if($user->Age<12)
        return response()->view('panel.child.off',compact('headers'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
        else
        return response()->view('panel.teenager.off',compact('headers'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')  
        ->header('Pragma', 'no-cache')  
        ->header('Expires', '0');
    }
    function OfflineShow($id,Request $req)
    {
        $user=session('User');
        if(!($user->FisrtClass??0))
        {
            $fc1=[38,39,40,41];
            $fc2=[51,52];      
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereIn('AppId',$fc1)->count())
            $user->FisrtClass=1;
            else
            $user->FisrtClass=2;
        }
        if($user->FisrtClass==1)
        abort(403);
        $headers=Collection::make($this->getData('select',['uid'=>$user->Id],'AbstractFile',1));   
       /* $headers=[
            "1-12"=>['Title'=>"نکات یک تا دوازده",'File'=>"https://kakheroshd.ir:448/RedCastleFileManager/first-class/abstarct/1-12.mp4"]
        ];*/
        $video=$headers->where('Id',$id)->first();
        return view('panel.teenager.offplay',compact('video'));
    }

    
    public function Work_index(Request $req)
    {
        $user=session('User'); 
        if(($user->ReserveAllow??-1)==-1)
        {    
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereNotNull('WorkTime')->count())
            $user->ReserveAllow=1;
            else
            $user->ReserveAllow=0;
            $user->GroupId=$apps->whereNotNull('WorkTime')->first()['GroupId']??0;
            $user->FC=$apps->whereNotNull('WorkTime')->first()['AppId']??0;

        }
        if(!$user->ReserveAllow)
        abort(403);

        $city=$this->getGroupInfo($user->GroupId)['City']??'';
        
        $reservation=$this->getData('update',['city'=>$city,'appid'=>$user->FC],'capacity',1); 
        $MyReserve=$this->getData('select',['city'=>$city,'uid'=>$user->Id,'appid'=>$user->FC],'MyReserve',1); 
        //$MyReserveAllow=$this->getData('select',['city'=>$city,'uid'=>$user->Id],'MyReserveAllow',1); 
        $CancelDays=$this->getData('select',['city'=>$city],'CancelDays',1); 
        $DaysReservation=$this->getData('select',['city'=>$city],'DaysReservation',1); 
       $tomorrow = Carbon::tomorrow();
       /* if($city=="تهران")
        $nextFriday = Carbon::now()->next('friday')->addWeek(2);
        else*/
        $nextFriday = Carbon::now()->next('friday')->addWeek();
        
        try
        {
         $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',           
                'api_token' => $this->api_token,
            ])->get('https://pnldev.com/api/calender?year='.jdate($tomorrow->format('Y-m-d'))->format('Y').'&month='.ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),'0'));
            if($response->ok())
                {
                     $data=$response->json();
                     if($data['status'])
                     {
                        $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),'0')]=$data['result'];
                     }
                }
                else
                    $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),'0')]=[];
                if(jdate($nextFriday->format('Y-m-d'))->format('m')!=jdate($tomorrow->format('Y-m-d'))->format('m'))
                {
                    $response = Http::withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded',           
                    'api_token' => $this->api_token,
                    ])->get('https://pnldev.com/api/calender?year='.jdate($nextFriday->format('Y-m-d'))->format('Y').'&month='.ltrim(jdate($nextFriday->format('Y-m-d'))->format('m'),'0'));
                    if($response->ok())
                        {
                            $data=$response->json();
                            if($data['status'])
                            {
                                $days[ltrim(jdate($nextFriday->format('Y-m-d'))->format('m'),'0')]=$data['result'];
                            }
                        }
                        else
                            $days[ltrim(jdate($nextFriday->format('Y-m-d'))->format('m'),'0')]=[];
                }
         
		} catch (\Throwable $th) {
           $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),'0')]=[];
           if(jdate($nextFriday->format('Y-m-d'))->format('m')!=jdate($tomorrow->format('Y-m-d'))->format('m'))
           $days[ltrim(jdate($nextFriday->format('Y-m-d'))->format('m'),'0')]=[];
        } 
       session(['days'=>$days]);

        if(!$req->ajax)
        {
           if($city=="تهران")
			{
			if($user->Age<12)
            return view('panel.child.reservationTehran',compact('reservation','tomorrow','nextFriday','city','MyReserve','CancelDays','days','DaysReservation'));
            else
            return view('panel.teenager.reservationTehran',compact('reservation','tomorrow','nextFriday','city','MyReserve','CancelDays','days','DaysReservation'));            
			}
            if($user->Age<12)
            return view('panel.child.reservation5',compact('reservation','tomorrow','nextFriday','city','MyReserve','CancelDays','days','DaysReservation'));
            else
            return view('panel.teenager.reservation5',compact('reservation','tomorrow','nextFriday','city','MyReserve','CancelDays','days','DaysReservation'));            
        }
        else
        {
            $out='';
            if($req->ajax==2)
            {
                while ($tomorrow->lessThanOrEqualTo($nextFriday))
                {
                        $type=3;
                    if($tomorrow->isFriday() || jdate($tomorrow)->getDayOfWeek()%2!=0)
                    {
                        $tomorrow = $tomorrow->addDay();  
                        $index=($index??0)+1;
                        continue;
                    }
                    $out.='<div class="col-12  d-flex" style="">
                            
                                <div class="title2 py-4 px-3 rounded-circle d-grid">
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('%A').'</span>
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('Y-m-d').'</span>                    
                                </div>
                                <div class="align-items-center col d-flex justify-content-between p-2 title shadow">
                                    <div class="align-items-center col d-grid">';
                                        if($type==3)
                                    $out.="<span>ساعت 15 الی 20 </span> ";
                                        else                                    
                                    $out.="<span>ساعت 11 الی 17 </span>";
                                    
                                    $out.='<small id="d'.($index??0).'">';
                                    if(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت لغو شده است ";
                                elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت بسته شده است ";
                                else
                                {
                                    $c=(8-($reservation->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0));
                                if($c>0)
                                $out.=" $c نفر باقی مانده";
                                else
                                $out.="تکمیل ظرفیت";
                                    }
                                    $out.='
                                        </small>
                                    </div>';
                                    if($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->where('Status',5)->count())
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)                                                              
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->whereNotIn('Status',[4,5])->count())
                                    $out.='<label class="btn-reserved d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-user-check"></i>
                                    </label>';
                                    elseif((8-($reservation->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))<=0)
                                    $out.='<label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle" >
                                        تکمیل
                                    </label>';
                                    else 
                                    $out.='<label class="btn-reserve c-pointer d-grid label p-3 rounded-circle" onclick="reservation(\''.$tomorrow->format('Y-m-d').'\','.$type.','.($index??0).',this)" >
                                        رزرو 
                                    </label>';
                        $out.='</div>
                            
                    </div>';
                    
                    $tomorrow = $tomorrow->addDay();  
                    $index=($index??0)+1;
                }

            }            
			elseif($req->ajax==5)
			{
                $capacity=8;
                $out='';
                while ($tomorrow->lessThanOrEqualTo($nextFriday))
                {
                    
                        $w = 0;
                        if (in_array(jdate($tomorrow)->getDayOfWeek(), [0, 1])) {
                            $w = 1;
                        }
                        if (!$tomorrow->isThursday()) {
                            if (
                                (($tomorrow->weekOfYear + $w) % 2 == 0 && jdate($tomorrow)->getDayOfWeek() % 2 == 0) ||
                                (($tomorrow->weekOfYear + $w) % 2 != 0 && jdate($tomorrow)->getDayOfWeek() % 2 != 0)
                            ) {
                               if($DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->count()<=0)
                                {
                                    $tomorrow = $tomorrow->addDay();
                                    $index = ($index ?? 0) + 1;
                                    continue;
                                }
                            }
                        }

                        if (in_array(jdate($tomorrow->format('Y-m-d'))->format('%A'), ['پنج‌شنبه'])) {
                            if (
                                (($tomorrow->weekOfYear + $w) % 2 == 0 && jdate($tomorrow)->getDayOfWeek() % 2 == 0) ||
                                (($tomorrow->weekOfYear + $w) % 2 != 0 && jdate($tomorrow)->getDayOfWeek() % 2 != 0)
                            ) {
                                $type = 3;
                            } else {
                                $type = 8;
                            }
                        } elseif (in_array(jdate($tomorrow->format('Y-m-d'))->format('%A'), ['جمعه'])) {
                            $type = 8;
                        } else {
                            $type = 3;
                        }
                         if($DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->count())
                            {
                                $capacity=$DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->first()['Capacity'];
                                $type=$DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->first()['Type'];
                            }
                    $out.='<div class="col-12 gap-2 d-flex" style="">
                            
                                <div class="title2 py-4 px-3 rounded-circle d-grid">
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('%A').'</span>
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('Y-m-d').'</span>                    
                                </div>
                                <div class="align-items-center col d-flex justify-content-between p-2 title shadow">
                                    <div class="align-items-center col d-grid"><span>';
                                    
                                    switch($type)
                                    {
                                        case 3:
                                            $out.='ساعت 15 الی 20';
                                        break;

                                        case 4:
                                           $out.='ساعت 11 الی 17';
                                        break;

                                        case 8:
                                            $out.='ساعت 10 الی 15';
                                        break;

                                        case 7:
                                            $out.='ساعت 10 الی 14';
                                        break;
                                    }
                                $out.='</span> 
                                    <small id="d'.($index??0).'">';								
                                if(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت لغو شده است ";
                                elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت بسته شده است ";
                                else
                                {
                                     $c=($capacity-($reservation->where('Date',$tomorrow->format('Y-m-d'))->where('Type',$type)->first()['cdate']??0));
                                    if($c>0)
                                    $out.=" $c نفر باقی مانده";
                                    else
                                    $out.="تکمیل ظرفیت";
                                }
                                    $out.='</small>
                                    </div>';
                                    if($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->where('Status',5)->count())
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->whereNotIn('Status',[4,5])->count())
                                    $out.='<label class="btn-reserved d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-user-check"></i>
                                    </label>';
                                    elseif(($capacity-($reservation->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))<=0)
                                    $out.='<label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle" >
                                        تکمیل
                                    </label>';
                                    else 
                                    $out.='<label class="btn-reserve c-pointer d-grid label p-3 rounded-circle" onclick="reservation(\''.$tomorrow->format('Y-m-d').'\','.$type.','.($index??0).',this)" >
                                        رزرو 
                                    </label>';
                        $out.='</div>';
                        
                            
                    $out.='</div>';
                    
                    $tomorrow = $tomorrow->addDay();  
                    $index=($index??0)+1;
                }

			}
			elseif($req->ajax==6)
			{
                $out='';
                while ($tomorrow->lessThanOrEqualTo($nextFriday))
                {
                    $capacity=15;
                   $w=0;
                    if(in_array(jdate($tomorrow)->getDayOfWeek(),[0,1]))
                        $w=1;
                        if(!in_array(jdate($tomorrow->format('Y-m-d'))->format('%A'),["پنج‌شنبه","جمعه"]))
                        {
                            if((($tomorrow->weekOfYear+$w )%2==0 && jdate($tomorrow)->getDayOfWeek()%2==0) || (($tomorrow->weekOfYear+$w) %2!=0 && jdate($tomorrow)->getDayOfWeek()%2!=0))
                            {
                               if($DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->count()<=0)
                                {
                                    $tomorrow = $tomorrow->addDay();
                                    $index = ($index ?? 0) + 1;
                                    continue;
                                }
                            }
                        }
                        else
                        {
                            if($DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->count()<=0)
                                {
                                    $tomorrow = $tomorrow->addDay();
                                    $index = ($index ?? 0) + 1;
                                    continue;
                                }
                        }
                    
                    if($days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                        {
                            if(($tomorrow->weekOfYear+$w )%2!=0)
                            $type=7;
                            else
                            $type=3;
                        }
                        else
                            $type=3;
                        
                         if($DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->count())
                            {
                                $capacity=$DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->first()['Capacity'];
                                $type=$DaysReservation->where('Day',$tomorrow->format('Y-m-d'))->first()['Type'];
                            }
                    $out.='<div class="col-12 gap-2 d-flex" style="">
                            
                                <div class="title2 py-4 px-3 rounded-circle d-grid">
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('%A').'</span>
                                        <span>'.jdate($tomorrow->format('Y-m-d'))->format('Y-m-d').'</span>                    
                                </div>
                                <div class="align-items-center col d-flex justify-content-between p-2 title shadow">
                                    <div class="align-items-center col d-grid"><span>';
                                    
                                    switch($type)
                                    {
                                        case 3:
                                            $out.='ساعت 15 الی 20';
                                        break;

                                        case 4:
                                           $out.='ساعت 11 الی 17';
                                        break;

                                        case 8:
                                            $out.='ساعت 10 الی 15';
                                        break;

                                        case 7:
                                            $out.='ساعت 10 الی 14';
                                        break;
                                    }
                                $out.='</span> 
                                    <small id="d'.($index??0).'">';								
                                if(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت لغو شده است ";
                                /*elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                $out.=" رزرو فضای کاری در این روز توسط مدیریت بسته شده است ";*/
                                else
                                {
                                     $c=($capacity-($reservation->where('Date',$tomorrow->format('Y-m-d'))->where('Type',$type)->first()['cdate']??0));
                                    if($c>0)
                                    $out.=" $c نفر باقی مانده";
                                    else
                                    $out.="تکمیل ظرفیت";
                                }
                                    $out.='</small>
                                    </div>';
                                    if($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->where('Status',5)->count())
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    /*elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';*/
                                    elseif(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                    $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-ban"></i>
                                    </label>';
                                    elseif($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->whereNotIn('Status',[4,5])->count())
                                    $out.='<label class="btn-reserved d-grid label px-3 py-3 rounded-circle" >
                                    <i class="fa fa-user-check"></i>
                                    </label>';
                                    elseif(($capacity-($reservation->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))<=0)
                                    $out.='<label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle" >
                                        تکمیل
                                    </label>';
                                    else 
                                    $out.='<label class="btn-reserve c-pointer d-grid label p-3 rounded-circle" onclick="reservation(\''.$tomorrow->format('Y-m-d').'\','.$type.','.($index??0).',this)" >
                                        رزرو 
                                    </label>';
                        $out.='</div>';
                        
                            
                    $out.='</div>';
                    
                    $tomorrow = $tomorrow->addDay();  
                    $index=($index??0)+1;
                }

			}
            else
            {
                $out='';
            while ($tomorrow->lessThanOrEqualTo($nextFriday))
            {
                if(!in_array(jdate($tomorrow->format('Y-m-d'))->format('%A'),["پنج‌شنبه","جمعه"]))
                    $type=3;
                else
                    $type=4;
                    $w=0;
                   if(in_array(jdate($tomorrow)->getDayOfWeek(),[0,1]))
                    $w=1;
                   if((($tomorrow->weekOfYear+$w )%2==0 && jdate($tomorrow)->getDayOfWeek()%2==0) || (($tomorrow->weekOfYear+$w) %2!=0 && jdate($tomorrow)->getDayOfWeek()%2!=0))
                   {
                    $tomorrow = $tomorrow->addDay();  
                    $index=($index??0)+1;
                    continue;
                   }
                $out.='<div class="col-12  d-flex" style="">
                        
                            <div class="title2 py-4 px-3 rounded-circle d-grid">
                                    <span>'.jdate($tomorrow->format('Y-m-d'))->format('%A').'</span>
                                    <span>'.jdate($tomorrow->format('Y-m-d'))->format('Y-m-d').'</span>                    
                            </div>
                            <div class="align-items-center col d-flex justify-content-between p-2 title shadow">
                                <div class="align-items-center col d-grid">';
                                    if($type==3)
                                $out.="<span>ساعت 15 الی 20 </span> ";
                                    else                                    
                                $out.="<span>ساعت 11 الی 17 </span>";
                                   
                                 $out.='<small id="d'.($index??0).'">';
								if(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                               $out.=" رزرو فضای کاری در این روز توسط مدیریت بسته شده است ";
							   elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                               $out.=" رزرو فضای کاری در این روز توسط مدیریت بسته شده است ";
							   else
							   {
                                $c=(8-($reservation->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0));
                               if($c>0)
                               $out.=" $c نفر باقی مانده";
                               else
                               $out.="تکمیل ظرفیت";
                                }
                                $out.='
                                     </small>
                                </div>';
                                if($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->where('Status',5)->count())
                                $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                                </label>';
                                elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)                                                              
                                $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                                </label>';
                                elseif(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                $out.='<label class=" d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                                </label>';
                                elseif($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->whereNotIn('Status',[4,5])->count())
                                $out.='<label class="btn-reserved d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-user-check"></i>
                                </label>';
                                elseif((8-($reservation->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))<=0)
                                $out.='<label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle" >
                                     تکمیل
                                </label>';
                                else 
                                $out.='<label class="btn-reserve c-pointer d-grid label p-3 rounded-circle" onclick="reservation(\''.$tomorrow->format('Y-m-d').'\','.$type.','.($index??0).',this)" >
                                     رزرو 
                                </label>';
                    $out.='</div>
                        
                </div>';
                
                $tomorrow = $tomorrow->addDay();  
                $index=($index??0)+1;
            }
                
            }
            return response()->json(['data'=>$out]);
        }
    }
    public function Work_reserve(Request $req)
    {
        $user=session('User'); 
        if(($user->ReserveAllow??-1)==-1)
        {    
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereNotNull('WorkTime')->count())
            $user->ReserveAllow=1;
            else
            $user->ReserveAllow=0;
            $user->GroupId=$apps->whereNotNull('WorkTime')->first()['GroupId']??0;
            $user->FC=$apps->whereNotNull('WorkTime')->first()['AppId']??0;

        }

        $city=$this->getGroupInfo($user->GroupId)['City']??'';
        if(!$user->ReserveAllow)
         abort(403);
        $CancelDays=$this->getData('select',['city'=>$city],'CancelDays',1); 
        
         //$allowHours=$this->getWorkAllow($user->Id)['Time']??1000;

        //$MyReserveAllow=(object)$this->getData('select',['city'=>$city,'uid'=>$user->Id],'MyReserveAllow',1)->first(); 
        if($req->Type==3)
        {
            $start="15:00:00";$end="20:00:00";
            $date=$req->Date." 15:00:00";
            $t=5;
        }
        elseif($req->Type==8)
        {
            $start="10:00:00";$end="15:00:00";
            $date=$req->Date." 10:00:00";
            $t=5;
        }
        elseif($req->Type==7)
        {
            $start="10:00:00";$end="14:00:00";
            $date=$req->Date." 10:00:00";
            $t=4;
        }
        else
        {
            $start="11:00:00";$end="17:00:00";
            $date=$req->Date." 11:00:00";
            $t=6;
        }
        /*if((($MyReserveAllow->totalhours??0)+$t)>$allowHours)
        return response()->json(['success'=>false,'message'=>'شما بیشتر از ساعت مجاز رزرو کردید']);*/
        if(($CancelDays->where('Type',$req->Type)->where('Date',$req->Date)->first()['cdate']??0)>0)
            return response()->json(['success'=>false,'message'=>'امکان رزرو فضای کاری در این تاریخ توسط مدیریت بسته شده است']);
        if($city!="تهران")
        {
		 $days=session('days');
        $dday=Carbon::parse($req->Date);
       if(!$dday->isFriday() && $days[ltrim(jdate($dday->format('Y-m-d'))->format('m'),0)][ltrim(jdate($dday->format('Y-m-d'))->format('d'),0)]['holiday']??0)
        return response()->json(['success'=>false,'message'=>'امکان رزرو فضای کاری در این تاریخ بسته شده است']);
        }
        $MyReserve=$this->getData('updateinsert',['city'=>$city,'uid'=>$user->Id,'date'=>$date,'type'=>$req->Type,'start'=>$start,'end'=>$end,'appid'=>$user->FC],'Reservation',0); 
        $reservation=$this->getData('update',['city'=>$city,'appid'=>$user->FC,'where'=>" and cast(Date as date)='".$date."' "],'capacity',1); 
       if($MyReserve)
       {
        $EventController=new EventController();
        $b=$EventController->ReserveWork($city);

        $MySupport=$this->getData('select',['uid'=>$user->Id],'MySupport',1);       
        if($MySupport->count()) 
        {
            $user->SellerId=$MySupport->first()['SellerId'];
            $user->SupportId=$MySupport->first()['SupportId'];
            session(['User'=>$user]);
        }
        $des=$user->FullName."  برای ".jdate($date)->format('l تاریخ d F Y')." از ساعت ".jdate($start)->format('H')." تا ساعت ".jdate($end)->format('H')." کارآموزی رزرو کرد";
        $this->getData('insertGetId',['type'=>19,'sid'=>$user->SellerId,'uid'=>$user->Id,'des'=>$des],'ReservationAlert',0); 
        $this->smsWork(1,['date'=>$date,'start'=>$start,'end'=>$end]);

       }

        return response()->json(['success'=>$MyReserve,'capacity'=>$reservation,'b'=>$b??1]);
    }
    public function Work_Myreserve(Request $req)
    {
        $user=session('User'); 
        if(($user->ReserveAllow??-1)==-1)
        {    
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereNotNull('WorkTime')->count())
            $user->ReserveAllow=1;
            else
            $user->ReserveAllow=0;
            $user->GroupId=$apps->whereNotNull('WorkTime')->first()['GroupId']??0;
            $user->FC=$apps->whereNotNull('WorkTime')->first()['AppId']??0;

        }
        $city=$this->getGroupInfo($user->GroupId)['City']??'';

        $MyReserve=(object)$this->getData('select',['city'=>$city,'uid'=>$user->Id,'appid'=>$user->FC],'MyReserve',1); 

        return response()->json(['success'=>$MyReserve->count(),'data'=>$MyReserve]);
    }
    public function Work_reserve_cancel(Request $req)
    {
        $user=session('User'); 
        
        if(($user->ReserveAllow??-1)==-1)
        {    
            $apps=$this->getData('select',['uid'=>$user->Id],'MyFCType',1); 
            if($apps->whereNotNull('WorkTime')->count())
            $user->ReserveAllow=1;
            else
            $user->ReserveAllow=0;
            $user->GroupId=$apps->whereNotNull('WorkTime')->first()['GroupId']??0;
            $user->FC=$apps->whereNotNull('WorkTime')->first()['AppId']??0;

        }
        $city=$this->getGroupInfo($user->GroupId)['City']??'';
        if(!$user->ReserveAllow)
         abort(403);        
        $MyReserves=$this->getData('select',['city'=>$city,'uid'=>$user->Id,'appid'=>$user->FC],'MyReserve',1); 
        $MyReserve=$this->getData('update',['city'=>$city,'uid'=>$user->Id,'rid'=>$req->RID,'appid'=>$user->FC],'CancelReservation',0); 
       if($MyReserve)
       {
        $EventController=new EventController();
        $b=$EventController->ReserveWork($city);

        $reserve=(object)$MyReserves->where('Id',$req->RID)->first();
        $MySupport=$this->getData('select',['uid'=>$user->Id],'MySupport',1);       
        if($MySupport->count()) 
        {
            $user->SellerId=$MySupport->first()['SellerId'];
            $user->SupportId=$MySupport->first()['SupportId'];
            session(['User'=>$user]);
        }
        $des=$user->FullName."  رزرو کارآموزی ".jdate($reserve->Date)->format('l تاریخ d F Y')." از ساعت ".jdate($reserve->StartTime)->format('H')." تا ساعت ".jdate($reserve->EndTime)->format('H')." رو لغو کرد";
        $this->getData('insertGetId',['type'=>19,'sid'=>$user->SellerId,'uid'=>$user->Id,'des'=>$des],'ReservationAlert',0); 
        $this->smsWork(2,['date'=>$reserve->Date,'start'=>$reserve->StartTime,'end'=>$reserve->EndTime]);
       }

        return response()->json(['success'=>$MyReserve,'b'=>$b??1]);
    }
    public function smsWork($sms,$data)
    {
        $user=session('User'); 
        switch($sms)
        {
        case '1':
            $SmsBody ="family عزیز،
                رزرو فضای کاری شما برای روز day مورخ date از ساعت start تا end با موفقیت ثبت شد.
                با تشکر";
            break;
        case '2':
            $SmsBody ="family عزیز،
                شما از رزرو فضای کاری در روز day مورخ date از ساعت start تا end انصراف دادید.
                در صورت تمایل به رزرو مجدد، لطفاً به اپلیکیشن مراجعه کنید.
                با تشکر";
            break;
        
        }
        $SmsBody=strtr($SmsBody,['day'=>jdate($data['date'])->format('l'),'date'=>jdate($data['date'])->format('d F'),'start'=>jdate($data['start'])->format('H'),'end'=>jdate($data['end'])->format('H'),'family'=>$user->FullName]);
       
        $url =  "http://sms.parsgreen.ir/Apiv2/Message/SendSms";
         $ch = curl_init($url);
         $Mobiles =  array($user->Phone);
         $SmsNumber = null;
         $myjson = ["SmsBody"=>$SmsBody, "Mobiles"=>$Mobiles,"SmsNumber"=>$SmsNumber];
     
        $jsonDataEncoded = json_encode($myjson);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $header =array('authorization: BASIC APIKEY:1F7ACF9B-67B5-4E02-A270-A3C377554AD2','Content-Type: application/json;charset=utf-8');
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        $result = curl_exec($ch);
        $res = json_decode($result);
        curl_close($ch);

         $msg=($res->R_Success??0)?"پیامک با موفقیت ارسال شد":"ارسال پیامک با شکست مواجه شد";
            $key=($res->R_Success??0)?"success":"error";
         return response()->json(['status'=>$key,'message'=>$msg]);
        
    }
    public function videotet(Request $req)
    {
        $link='https://appdev.erfankhoshnazar.com/Videos/test.mp4';
		return view('testvideo',compact('link'));

    }
    public function getGroupInfo($gid=0)
    {
        $groups=collection::make([
            [
                'Id'=>0,
                'Name'=>'',
                'Age'=>[0,0],
                'City'=>'',
                'Gender'=>"",
                'Count'=>0
            ],
            [
                'Id'=>8,
                'Name'=>'A',
                'Age'=>[8,13],
                'City'=>'اصفهان',
                'Gender'=>"پسر",
                'Count'=>8
            ],
            [
                'Id'=>9,
                'Name'=>'B',
                'Age'=>[11,13],
                'City'=>'اصفهان',
                'Gender'=>"دختر",
                'Count'=>9
            ],
            [
                'Id'=>10,
                'Name'=>'C',
                'Age'=>[14,20],
                'City'=>'اصفهان',
                'Gender'=>"دختر",
                'Count'=>7
            ],
            [
                'Id'=>11,
                'Name'=>'D',
                'Age'=>[14,20],
                'City'=>'اصفهان',
                'Gender'=>"پسر",
                'Count'=>11
            ],

            [
                'Id'=>12,
                'Name'=>'E',
                'Age'=>[9,12],
                'City'=>'تهران',
                'Gender'=>"پسر",
                'Count'=>8
            ],
            [
                'Id'=>13,
                'Name'=>'F',
                'Age'=>[12,13],
                'City'=>'تهران',
                'Gender'=>"پسر",
                'Count'=>8
            ],
            [
                'Id'=>14,
                'Name'=>'G',
                'Age'=>[13,16],
                'City'=>'تهران',
                'Gender'=>"پسر",
                'Count'=>8
            ],
            [
                'Id'=>15,
                'Name'=>'H',
                'Age'=>[16,19],
                'City'=>'تهران',
                'Gender'=>"پسر",
                'Count'=>8
            ],
            [
                'Id'=>16,
                'Name'=>'I',
                'Age'=>[12,14],
                'City'=>'تهران',
                'Gender'=>"دختر",
                'Count'=>10
            ],
            [
                'Id'=>17,
                'Name'=>'J',
                'Age'=>[15,20],
                'City'=>'تهران',
                'Gender'=>"دختر",
                'Count'=>10
            ],

            [
                'Id'=>18,
                'Name'=>'K',
                'Age'=>[10,17],
                'City'=>'شیراز',
                'Gender'=>"مختلط",
                'Count'=>11
            ],
            [
                'Id'=>19,
                'Name'=>'L',
                'Age'=>[11,19],
                'City'=>'مشهد',
                'Gender'=>"مختلط",
                'Count'=>9
            ],
            [
                'Id'=>20,
                'Name'=>'M',
                'Age'=>[15,18],
                'City'=>'تبریز',
                'Gender'=>"مختلط",
                'Count'=>6
            ],
            ]);
            if($gid=='all')
            return $groups->where('Id','<>',0);
            else
            return $groups->where('Id',$gid)->first();
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
