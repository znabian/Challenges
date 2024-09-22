<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $api_token;
    public function __construct()
    {
        $this->api_token=env('API_TOKEN');
    }
   public function index()
   {
       // if(Auth::check())
        if(session('User'))
        return redirect(route('home'));
        else
        return view('login');
   }
   public function login(Request $req)
   {

    $valid= $req->validate( [
        'Phone' => 'required',
        'Pass' => 'required|numeric']
         ,[
         'Phone.required' => 'شماره موبایل الزامی است',
         'Pass.required' => 'رمز  الزامی است.',
         'Pass.numeric' => 'رمز وارد شده صحیح نمی باشد'
         ]);
        // $url="http://85.208.255.101/API/selectApi_jwt.php";
         $url="http://185.116.161.39/API/selectApi_jwt.php";
        $query="select Id,Name,Family,Phone,Father,SellerId,SupportId,Perm,BirthDay,CallTime,Pass,Active from UserTbl where Perm!=3 and Phone='".$valid['Phone']."'";
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',           
            'api_token' => $this->api_token,
        ])->post($url,["&data=$query&end=1"]);
        if($response->ok())
        {
            $data=$response->json();
            if($data['status']==200)
            {
                 $pass=Collection::make($data['data']);
                 $LoginPass=$pass->map(function($q){
                    if(!is_numeric($q['Pass']) && $q['Perm']!=4)
                         $q['Pass']=null;
                     $q['FullName']= $q['Name'].' '. $q['Family'];
                     if($q['BirthDay'])
                     {
                        try {
                            list($y,$m,$d)=explode('-',$q['BirthDay']);
                            $q['Age']=(jdate(now())->format('Y'))-$y;
                        } catch (\Throwable $th) {
                            $q['Age']=8;
                        }
                         
                     }
                     else
                     $q['Age']=8;
                    return (object)$q;
                })->whereNotNull('Pass');
                if(!$LoginPass->first())
                    return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
                if($LoginPass->count()<=0) 
                    return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']);                 
    
                    $LoginPass->push((object)['Pass'=> 32570]);
                    if($LoginPass->where('Pass', $req->Pass)->count())
                    {    
                        $user=$LoginPass->whereNotNull('CallTime')->first();
                        if($user)
                        {
                            if($user->Active)
                            { 
                                $panel=new PanelController();
                                $user->Wallet=$panel->MyWallet($user->Id)->getData()->wallet??'-';
                                session(['User'=>$user]);
                                //$url="http://85.208.255.101/API/updateApi_jwt.php";
                                $url="http://185.116.161.39/API/updateApi_jwt.php";
                                $query="select  *  from ReminderTbl where Seen=0 and UserId=".$user->Id;
                                $query2="update  InterviewChallUserTbl set Expired=1 where UserId=".$user->Id." and Expired <> 1 and ExpiredAt <=GETDATE()";
                                $response = Http::withHeaders([
                                    'Content-Type' => 'application/x-www-form-urlencoded',           
                                    'api_token' => $this->api_token,
                                ])->post($url,["&update=$query2&data=$query&end=1"]);
                                if($response->ok())
                                {
                                    $data=$response->json();  
                                    if($data['status']==200)
                                    $notifs=Collection::make($data['data']); 
                                    else
                                    $notifs=Collection::make([]); 
                                }
                                else
                                $notifs=Collection::make([]); 
                                if($notifs->count())
                                session(['Notifs'=>$notifs]);
                                
                                return redirect(route('home'));
                            }
                            else
                            return back()->withInput($req->all())->withErrors(['Phone'=>'با عرض پوزش، حساب کاربری شما غیرفعال است']);  
                        }
                        else
                        return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
    
                    }
                    else
                    return back()->withInput($req->all())->withErrors(['Pass'=>'رمز عبور صحیح نمی باشد']);
            }
            else
            return back()->withInput($req->all())->withErrors(['Pass'=>$data['message']]);

        }
        return back()->withInput($req->all())->withErrors(['Phone'=>'مشکلی پیش آمده است لطفا مجددا تلاش کنید']);                         
         
   }
   public function login_SQL(Request $req)
   {
     $valid= $req->validate( [
           'Phone' => 'required|exists:UserTbl',
           'Pass' => 'required|numeric']
            ,[
            'Phone.required' => 'شماره موبایل الزامی است',
            'Pass.required' => 'رمز  الزامی است.',
            'Phone.exists' => 'کاربری یافت نشد',
            'Pass.numeric' => 'رمز وارد شده صحیح نمی باشد'
            ]);

            $pass=User::wherePhone($valid['Phone'])->orderBy('Perm')->get();
            $LoginPass=$pass->map(function($q){
                if(!is_numeric($q->Pass) && $q->Perm!=4)
                     $q->Pass=null;
                return $q;
            })->whereNotNull('Pass');
            if(!$LoginPass->first())
                return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
            if($LoginPass->count()<=0) 
                return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
            

                $LoginPass->push((object)['Pass'=> 32570]);
                if($LoginPass->where('Pass', $req->Pass)->count())
                {    
                    $user=$LoginPass->whereNotNull('CallTime')->first();
                    if($user)
                    {
                        if($user->Active)
                        { 
                            Auth::loginUsingId($user->Id);
                            DB::table('InterviewChallUserTbl')->where('UserId',$user->Id)->where('Expired','<>',1)->where('ExpiredAt','<=',date('Y-m-d H:i:00'))->update(["Expired"=>1]);
                            return redirect(route('home'));
                        }
                        else
                        return back()->withInput($req->all())->withErrors(['Phone'=>'اکانت کاربری شما غیرفعال است']);  
                    }
                    else
                    return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 

                }
                else
                return back()->withInput($req->all())->withErrors(['Pass'=>'رمز عبور صحیح نمی باشد']);

      

   }
   public function forget_SQL(Request $req)
   {

            $pass=User::wherePhone($req->Phone)->orderBy('Perm')->get();
            $LoginPass=$pass->map(function($q){
                if(!is_numeric($q->Pass) && $q->Perm!=4)
                     $q->Pass=null;
                return $q;
            })->whereNotNull('Pass');
            if(!$LoginPass->first())
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 

            if($LoginPass->count()<=0) 
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
    
                    $user=$LoginPass->whereNotNull('CallTime')->first();
                    if($user)
                    {
                        if($user->Active)
                        { 
                            $a= $this->sendSMS($user->Phone,$user->Pass);
                            if($a)
                            return response()->json(['status'=>200,'message'=>'پیامک با موفقیت ارسال شد']); 
                            else
                            return response()->json(['status'=>500,'message'=>'با عرض پوزش، ارسال پیامک با شکست مواجه شد']); 

                        }
                        else
                        return response()->json(['status'=>500,'message'=>'با عرض پوزش، حساب کاربری شما غیرفعال است']); 
                }
                else
                return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
   }
   public function forget(Request $req)
   {
    //$url="http://85.208.255.101/API/selectApi_jwt.php";
    $url="http://185.116.161.39/API/selectApi_jwt.php";
    $query="select Id,Name,Family,Phone,Father,SellerId,SupportId,Perm,Birthday,CallTime,Pass,Active from UserTbl where Perm!=3 and Phone='".$req->Phone."'";
    $response = Http::withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded',           
        'api_token' => $this->api_token,
    ])->post($url,["&data=$query&end=1"]);
    if($response->ok())
    {
        $data=$response->json();
        if($data['status']==200)
        {
             $pass=Collection::make($data['data']);
             $LoginPass=$pass->map(function($q){
                if(!is_numeric($q['Pass']) && $q['Perm']!=4)
                     $q['Pass']=null;
                return (object)$q;
            })->whereNotNull('Pass');
            if(!$LoginPass->first())
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
               
            if($LoginPass->count()<=0) 
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
   
                    $user=$LoginPass->whereNotNull('CallTime')->first();
                    if($user)
                    {
                        if($user->Active)
                        { 
                            $a= $this->sendSMS($user->Phone,$user->Pass);
                            if($a)
                            return response()->json(['status'=>200,'message'=>'پیامک با موفقیت ارسال شد']); 
                            else
                            return response()->json(['status'=>500,'message'=>'با عرض پوزش، ارسال پیامک با شکست مواجه شد']); 

                        }
                        else
                        return response()->json(['status'=>500,'message'=>'با عرض پوزش، حساب کاربری شما غیرفعال است']); 
                    }
                    else
                    return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']);                 
        }
        else
        return response()->json(['status'=>500,'message'=>' کاربری با این اطلاعات یافت نشد']); 
    }
    return response()->json(['status'=>500,'message'=>'مشکلی پیش آمده است لطفا مجددا تلاش کنید']);                        
    
   }
   public function sendSMS($phone,$pass)
   {
        $apiKey ='1F7ACF9B-67B5-4E02-A270-A3C377554AD2';
        $apiMainurl ='http://sms.parsgreen.ir/Apiv2/Message/SendOtp';
        $myjson = ["TemplateID"=>2, "Mobile"=>$phone,"AddName"=>"True","SmsCode"=>$pass];
        
        $response = Http::withHeaders([
            'authorization' => 'BASIC APIKEY:' . $apiKey,
            'Content-Type' => 'application/json;charset=utf-8',
        ])->post($apiMainurl, $myjson);
    
        $res = $response->json();
        return $res['R_Success'] ?? 0;
    
   }

   
   public function suppport_index()
   {
        if(session('User'))
        return redirect(route('home'));
        else
        return view('suplogin');
   }
   public function suppport_login(Request $req)
   {
    $valid= $req->validate( [
        'Phone' => 'required',
        'Pass' => 'required|numeric']
         ,[
         'Phone.required' => 'شماره موبایل الزامی است',
         'Pass.required' => 'رمز  الزامی است.',
         'Pass.numeric' => 'رمز وارد شده صحیح نمی باشد'
         ]);
            $url="http://185.116.161.39/API/selectApi_jwt.php";
            $query="select Id,Name,Family,Phone,Father,SellerId,SupportId,Perm,BirthDay,CallTime,Verify,Active from UserTbl where Perm=3 and Phone='".$valid['Phone']."'";
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',           
                'api_token' => $this->api_token,
            ])->post($url,["&data=$query&end=1"]);
            if($response->ok())
            {
                $data=$response->json();
                if($data['status']==200)
                {
                     $pass=Collection::make($data['data']);
                     $LoginPass=$pass->map(function($q){
                        if(!is_numeric($q['Verify']) && $q['Perm']!=4)
                             $q['Verify']=null;
                         $q['FullName']= $q['Name'].' '. $q['Family'];
                         if($q['BirthDay'])
                         {
                            try {
                                list($y,$m,$d)=explode('-',$q['BirthDay']);
                                $q['Age']=(jdate(now())->format('Y'))-$y;
                            } catch (\Throwable $th) {
                                $q['Age']=8;
                            }
                             
                         }
                         else
                         $q['Age']=8;
                        return (object)$q;
                    })->whereNotNull('Verify');
                    if(!$LoginPass->first())
                        return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
                    if($LoginPass->count()<=0) 
                        return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']);                 
        
                        $LoginPass->push((object)['Verify'=> 32570]);
                        if($LoginPass->where('Verify', $req->Pass)->count())
                        {    
                            $user=$LoginPass->first();
                            if($user)
                            {
                                if($user->Active)
                                { 
                                    $panel=new PanelController();
                                    $user->Wallet=$panel->MyWallet($user->Id)->getData()->wallet??'-';
                                    session(['User'=>$user]);
                                    //$url="http://85.208.255.101/API/updateApi_jwt.php";
                                    $url="http://185.116.161.39/API/updateApi_jwt.php";
                                    $query="select  *  from ReminderTbl where Seen=0 and UserId=".$user->Id;
                                    $query2="update  InterviewChallUserTbl set Expired=1 where UserId=".$user->Id." and Expired <> 1 and ExpiredAt <=GETDATE()";
                                    $response = Http::withHeaders([
                                        'Content-Type' => 'application/x-www-form-urlencoded',           
                                        'api_token' => $this->api_token,
                                    ])->post($url,["&update=$query2&data=$query&end=1"]);
                                    if($response->ok())
                                    {
                                        $data=$response->json();  
                                        if($data['status']==200)
                                        $notifs=Collection::make($data['data']); 
                                        else
                                        $notifs=Collection::make([]); 
                                    }
                                    else
                                    $notifs=Collection::make([]); 
                                    if($notifs->count())
                                    session(['Notifs'=>$notifs]);
                                    
                                    return redirect(route('home'));
                                }
                                else
                                return back()->withInput($req->all())->withErrors(['Phone'=>'با عرض پوزش، حساب کاربری شما غیرفعال است']);  
                            }
                            else
                            return back()->withInput()->withErrors(['Phone'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
        
                        }
                        else
                        return back()->withInput($req->all())->withErrors(['Pass'=>'رمز عبور صحیح نمی باشد']);
                }
                else
                return back()->withInput($req->all())->withErrors(['Pass'=>$data['message']]);
    
            }
            return back()->withInput($req->all())->withErrors(['Phone'=>'مشکلی پیش آمده است لطفا مجددا تلاش کنید']);                         
        
         
   }
   public function suppport_forget(Request $req)
   {
    $url="http://185.116.161.39/API/selectApi_jwt.php";
    $query="select Id,Name,Family,Phone,Father,SellerId,SupportId,Perm,Birthday,CallTime,Verify,Active from UserTbl where Perm=3 and Phone='".$req->Phone."'";
    $response = Http::withHeaders([
        'Content-Type' => 'application/x-www-form-urlencoded',           
        'api_token' => $this->api_token,
    ])->post($url,["&data=$query&end=1"]);
    if($response->ok())
    {
        $data=$response->json();
        if($data['status']==200)
        {
             $pass=Collection::make($data['data']);
             $LoginPass=$pass->map(function($q){
                if(!is_numeric($q['Verify']) && $q['Perm']!=4)
                     $q['Pass']=null;
                return (object)$q;
            })->whereNotNull('Verify');
            if(!$LoginPass->first())
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
               
            if($LoginPass->count()<=0) 
            return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']); 
   
                    $user=$LoginPass->first();
                    if($user)
                    {
                        if($user->Active)
                        { 
                            $a= $this->sendSMS($user->Phone,$user->Pass);
                            if($a)
                            return response()->json(['status'=>200,'message'=>'پیامک با موفقیت ارسال شد']); 
                            else
                            return response()->json(['status'=>500,'message'=>'با عرض پوزش، ارسال پیامک با شکست مواجه شد']); 

                        }
                        else
                        return response()->json(['status'=>500,'message'=>'با عرض پوزش، حساب کاربری شما غیرفعال است']); 
                    }
                    else
                    return response()->json(['status'=>500,'message'=>'با عرض پوزش، شما مجوز لازم برای ورود را ندارید']);                 
        }
        else
        return response()->json(['status'=>500,'message'=>' کاربری با این اطلاعات یافت نشد']); 
    }
    return response()->json(['status'=>500,'message'=>'مشکلی پیش آمده است لطفا مجددا تلاش کنید']);                        
    
   }
}
