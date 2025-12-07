@php    
use Carbon\Carbon;  
@endphp
@extends('layouts.app')
@section('style')
<style>
    .row>*
    {
        margin-bottom: 2% !important;
    }
        #content
        {
            color: #535353;            
            max-height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
        }
        .card {
            background: #fdfdfd;
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
            /* border: 1px solid #edc587; */
            color: #616161;
            /* padding: 10px; */
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            /* margin-bottom: 30px; */
            max-height: 170px;
            /* width: 45%; */
        }
        .noinfo
        {
            background: #fff;
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
           
            color: #616161;
            padding: 8%;
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            margin-top: 20%;
        }
        .btn-master
        {
            background:linear-gradient(to left, #7a7a7a, #3c3c3c);
            border: 1px solid #fff;
            border-radius: 15px;
            color: #fff;
            padding: 2px;
            width: 45px;
            /* font-size: 15pt!important; */
            box-shadow: 5px 5px 8px -5px #a79f9f;
        }
                .logo
                {
                    height: 15vh;
                    width: 15vh;
                    box-shadow: 0 0 5px 1px #191b41; 
                }
                .circle
                {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background-color: #b5b5b5;
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 15px;
                    font-family: 'Vazir';

                }
                .status {
                border-radius: 50%;
                background-color: #b5b5b5;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size:13px;   
                border: none;
                font-weight: bolder;
                width: 20px;
                height: 20px;
            }
            i.status.fa-close
            {                
                /* color: #ffa1a3; */
                /* background-color: #727272!important; */
                background-color: #E91E63!important;
            }
            i.status.fa-check
            {                
                /* color: #9effc2; */
                background-color: #38a274!important;
            }
            i.status .fa-exclamation
            {                
                /* color: #e9dd3d; */
            }
    </style>
    <style>
         /* @media (max-width: 488px)
            { */
                
                .logo
                {
                    height: 17vh!important;
                    width: 100%!important;
                }
                .content-center
                {
                    width: 22vw!important;
                    margin: auto;
                }
                .card {
                   
                    padding: unset!important;
                font-size: 10pt!important;
                } 
                .btn-master {
                    /* width: 40px!important; */
                    /* font-size: 12pt!important; */
                    /* margin-left: 1px!important; */
                    /* margin-top: 6px; */
                }
        /* } */
        .imgicon {
            width: 5rem;
            height: 5rem;
            border: 1px solid white;
        }
        .subtitle
        {
            color: #413f3f;
            font-family:Peyda;
            font-size: 6pt;
            font-weight: 100;
        }
        .title
        {
            /*color: #676767;*/
            font-size: 9pt; 
            border-radius: 15px ;
            text-align: center;
            color: #343E66;
            background: #f6f6f6;
            font-family: 'Peyda';
            font-weight: 400;

        }
        .title2
        {
            /*color: #676767;*/
            border-radius: 0 0  25px 25px;
            text-align: center;
            color: #b59f64;
            background: #4c4c4c;
            font-family: 'Peyda';
            font-weight: 500;
            font-size: 8pt;
            margin-left: -45px;
            z-index: 10;
            box-shadow: inset 0 0 5px 0.5px #060606;

        }
        .btnplay
        {
            width: 50px;
            height: 50px;
            bottom: -1rem;
            cursor: pointer;
        }
      
        #content
        {
            /* background-image: url("{{asset('img/home/side.png')}}");
            background-size: 121px;
            background-repeat: no-repeat;
            background-position: left; */
            padding: 0!important;
            background-attachment:fixed;
        }
        .circleImg {
                width: 73px;
                height: 73px;
                border-radius: 50%;
                background-color: #ffffff;
                color: #fff;
                position: absolute;
                top: 13px;
                right: 4px;
            }
        @media (min-width: 760px)
        {
            #content
            {
                background-size: 101px!important;
                background-attachment:scroll!important;
                width: 100%;
            }
            #content2
            {
                
            }
        }
        #content
        {
            background-image: url("{{asset('img/home/back.svg')}}");
            background-color: #fff;
            background-blend-mode: darken;
        }
        body
        {
            background-color: #f6f6f6;
        }
        .content2
        {
            /*height:unset!important;*/
        }
        .card-body
        {
            padding: 9px;
        }
        .imgheader 
        {
            width: 100%;
            height: 13rem;
            background-color: #fff;
        }
        .info
         {
            width: 70%;
            font-family: 'Peyda';
            text-align: center;
            font-size: 10pt;
            box-shadow: 0px 4px 9px 0px #343e668f;
            padding: 2rem;
            border-radius: 15px;
            background-color: white;
            border: 2px solid #343e66;
            margin-top: 15%;
        }
        b
        {
            color: #343e66;
        }
        .btn-reserved
        {
            background-color: #33a54c;
            color: #fff;
            font-size: 9pt;
            border: 1px solid #f6f6f6;
            box-shadow: inset 0px 0px 6px 0px #343e6640;
            cursor: no-drop;
        }
        .btn-reserve
        {
            background-color: white;
            color: #343e66;
            font-size: 9pt;
            border: 1px solid #f6f6f6;
            box-shadow: inset 0px 0px 6px 0px #343e6640;
        }
        .btn-reserve:hover
        {
            color: white;
            background-color: #343e66;
            border: 1px solid #343e66;
            box-shadow: inset 0px 0px 6px 0px #343e6640;
        }
        .btn-cancel
        {
            background-color: white;
            color: #bf0629;
            font-size: 9pt;
            border: 1px solid #f6f6f6;
            box-shadow: inset 0px 0px 6px 0px #bf062940;
        }
        .btn-cancel:hover
        {
            color: white;
            background-color: #bf0629;
            border: 1px solid #bf0629;
            box-shadow: inset 0px 0px 6px 0px #bf062940;
        }
    </style>
@endsection

@section('title')  
فضای کاری
@endsection
@section('content')   

<div id="content2" class="content2 " >    
   <a class="btn btn-outline-dark btn-sm btn-xs fa fa-arrow-left pull-left d-none " id="backurlIcon"></a>  
      
    <div class="gap-lg-0 gap-md-4 h-auto justify-content-center row m-md-auto">
        <div id="startDiv" class="info animate__animate animate__fadeOut d-none  ">
            <h5>{{session('User')->FullName}} عزیز! شما در حال رزرو فضای کار اشتراکی برای شهر <b>{{$city}}</b>،  هستید!</h5>
            <p class=" text-center">
                اگر کلاس شما در <b>{{$city}}</b>، نیست، لطفاً به پشتیبان خود بگویید تا اطلاعات شما را بروز کند.
                اگر همه چیز درست است، روی دکمه "شروع" کلیک کنید!
            </p>
            
            <label class="col-3 align-items-center rounded-2 c-pointer d-flex gap-2 justify-content-center label label-primary mx-auto" onclick="$('#startDiv').hide();$('#daysDiv').show();">
                شروع 
                <i class="fa fa-arrow-left-long"></i>
            </label>

        </div>
        <div id="helpDiv" class="info animate__animate animate__fadeOut  ">
            
            <h5>{{session('User')->FullName}} خوش آمدید!</h5>
            <p style="text-align: justify;">
                با کلیک بر روی دکمه "شروع"، شما به بخش انتخاب فضای کاری منتقل می‌شوید. در اینجا می‌توانید روز دلخواه خود را برای رزرو انتخاب کنید.
            </p>
            <p style="text-align: justify;">
                برای مشاهده تمام روزهایی که فضای کاری را رزرو کرده‌اید، بر روی دکمه "رزروهای من" کلیک کنید. 
            </p>
            <div class="d-flex">
                <label class="col-3 align-items-center rounded-2 c-pointer d-flex gap-2 justify-content-center btn btn-outline-dark btn-sm mx-auto" onclick="showDives('#helpDiv','#daysDiv')">
                    شروع 
                    <i class="fa fa-arrow-left-long"></i>
                </label>
                <label class="align-items-center c-pointer col-3 d-flex gap-2 justify-content-center btn btn-outline-dark btn-sm ltr mx-auto rounded-2" onclick="showDives('#helpDiv','#reserveDiv',1);">
                    رزروهای من 
                    <i class="fa fa-calendar-alt"></i>
                </label>
            </div>

        </div>
        <div id="daysDiv" class="animate__animate animate__fadeIn row" style=" display:none; ">   
       @while ($tomorrow->lessThanOrEqualTo($nextFriday))
        @php
        $capacity=8;
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
        @endphp
            <div class="col-12  d-flex" style="">
                
                {{-- <div class="card col-12 col-md-10 p-md-3 mh-100" > --}}
                    
                        <div class="title2 py-4 px-3 rounded-circle d-grid">
                                <span>{{jdate($tomorrow->format('Y-m-d'))->format('%A')}}</span>
                                <span>{{jdate($tomorrow->format('Y-m-d'))->format('Y-m-d')}}</span>                    
                        </div>
                        <div class="align-items-center col d-flex justify-content-between p-2 title shadow">
                            <div class="align-items-center col d-grid">
                                <span>
                                @switch($type)
                                    @case(3)
                                      ساعت 15 الی 20  
                                    @break
                                    @case(4)
                                     ساعت 11 الی 17   
                                    @break
                                    @case(8)
                                     ساعت 10 الی 15   
                                    @break
                                    @case(7)
                                     ساعت 10 الی 14   
                                    @break                                        
                                @endswitch
                                </span>
                                <small id="d{{$index??0}}">
								@if(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
 								رزرو فضای کاری در این روز توسط مدیریت لغو شده است 
								{{-- @elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                                رزرو فضای کاری در این روز توسط مدیریت بسته شده است  --}}
                               @else
                                @if($isFull)
                                    تکمیل ظرفیت
                                @else
                                    @if($capacity-($reservation->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)
                                    {{($capacity-($reservation->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))}} نفر باقی مانده
                                    @else
                                    تکمیل ظرفیت
                                    @endif
                                @endif
								@endif
                                 </small>
                            </div>                                      
                            
                            @if($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->where('Status',5)->count())
                           <label class="d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                            </label>
							@elseif(($CancelDays->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0)>0)    
                           <label class="d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                            </label>   
                           
                            @elseif($MyReserve->where('dday',$tomorrow->format('Y-m-d'))->where('Type',$type)->whereNotIn('Status',[4,5])->count())
                           <label class="btn-reserved d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-user-check"></i>
                            </label>
                            {{-- @elseif(!$tomorrow->isFriday() && $days[ltrim(jdate($tomorrow->format('Y-m-d'))->format('m'),0)][ltrim(jdate($tomorrow->format('Y-m-d'))->format('d'),0)]['holiday']??0)
                           <label class="d-grid label px-3 py-3 rounded-circle" >
                                 <i class="fa fa-ban"></i>
                            </label>                            --}}
                            @elseif(($capacity-($reservation->where('Type',$type)->where('Date',$tomorrow->format('Y-m-d'))->first()['cdate']??0))<=0)
                            <label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle">
                                 تکمیل
                            </label>
                            @elseif($isFull) 
                            <label class="btn-reserved bg-danger d-grid label px-2 py-3 rounded-circle">
                                 تکمیل
                            </label>
                            @else 
                            <label class="btn-reserve c-pointer d-grid label p-3 rounded-circle" onclick="reservation('{{$tomorrow->format('Y-m-d')}}',{{$type}},{{$index??0}},this)" >
                                 رزرو 
                            </label>
                            @endif
                        </div>
                    
                {{-- </div> --}}
            </div>
            @php
            $tomorrow = $tomorrow->addDay();  
            $index=($index??0)+1;
            @endphp
            @endwhile

        </div>
            
    
        <div id="reserveDiv" class="animate__animate animate__fadeIn row" style=" display:none; ">    
            @php
                $totalHours =0;   $myHours =0;  
            @endphp
            @foreach ($MyReserve->sortBy('Date')->sortBy('Status') as $item)
            <div class="col-12  d-flex" style="">
                    
                        <div class="title2 py-4 px-3 rounded-circle d-grid">
                                <span>{{jdate($item['Date'])->format('%A')}}</span>
                                <span>{{jdate($item['Date'])->format('Y-m-d')}}</span>                    
                        </div>
                        <div class="align-items-center col d-flex justify-content-between p-2 title shadow   @if($item['Date']<date('Y-m-d')) bg-secondary-subtle @endif">
                            <div class="align-items-center col d-grid">
                               @switch($item['Type'])
                                    @case(3)
                                      ساعت 15 الی 20  
                                    @break
                                    @case(4)
                                     ساعت 11 الی 17   
                                    @break
                                    @case(8)
                                     ساعت 10 الی 15   
                                    @break
                                    @case(7)
                                     ساعت 10 الی 14   
                                    @break                                        
                                @endswitch
                            </div> 
                            @if($item['Status']==1 || $item['Status']==3)
                            <label class="d-grid label px-3 py-3 rounded-circle text-success">
                                <i class="fa fa-2x fa-circle-check"></i>
                           </label>
                            @elseif($item['Status']==2)
                            <label class="d-grid label px-3 py-3 rounded-circle text-danger">
                                <i class="fa fa-2x fa-user-xmark"></i>
                                عدم حضور
                           </label>
                           @elseif(in_array($item['Status'],[4,5]))
                            <label class="d-grid label px-3 py-3 rounded-circle text-danger">
                                <i class="fa fa-2x fa-triangle-exclamation"></i>
                                @if($item['Status']==5)
                                لغو شده
                                @else
                                انصراف
                                @endif
                           </label>
                           @elseif($item['Status']==0)
                           <label class="btn-cancel c-pointer d-grid label p-3 rounded-circle" onclick="Cancelreservation('{{$item['Id']}}',this)" >
                               لغو
                          </label>
                           @endif
                        </div>
            </div>
            @php
                 $checkIn = Carbon::parse($item['StartTime']);
                $checkOut = Carbon::parse($item['EndTime']);
            if($item['Status']==1)
                $myHours += $checkOut->diffInHours($checkIn);
            if($item['Status']==3)
                $myHours += $checkOut->diffInHours($checkIn);
            if(!in_array($item['Status'],[4,5]))
                $totalHours += $checkOut->diffInHours($checkIn);
                
            @endphp
            @endforeach
            <div class="col-12  d-flex" style="">
                    
                        
                <div class="align-items-center col d-flex justify-content-between p-4 title" style="border: 1px dashed #343E66;background: transparent;">
                    <div class="align-items-center col d-grid">
                         <span>{{"شما ".$myHours.' ساعت  در فضای کاری اشتراکی حضور داشتید '}}</span> 

                    </div> 
                </div>
            </div>
    
        </div>
    

    </div>
</div>

        
@endsection
@section('script')
<script>
    var resFlag=false;
    const ably2 = new Ably.Realtime.Promise('{{env('ABLY_KEY')}}');
    ably2.connection.once('connected');
    var channel4 = ably2.channels.get('workReserve-Change.{{$city}}');
    channel4.subscribe('workReserveChange', workReserveChange);

    function workReserveChange()
    {

      axios.get('{{route("work.index",["ajax"=>6])}}') .then(response =>
      {
        Swal.close();
        daysDiv.innerHTML=response.data.data;  
      });   
        
    }
    function reservation(date,type,index,obj)
    {
        Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
            axios.post('{{route("work.res")}}', {Date:date,Type:type})
                  .then(response => { 
                    if(response.data.success)
                    {
                        //if(response.data.b==0)
                        workReserveChange();                    
                        showMyReserves();
                    }
                        
                    else
                        Swal.fire({
                                  icon: 'error',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.message??' مشکل پیش آمده ',
                              });
                    })
                  .catch(error => {
                      console.log(error);
                      Swal.fire({
                                  icon: 'error',
                                  title: 'خطا',                        
                                  confirmButtonText: 'بله',
                                  //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                  html:"مشکل پیش آمده دوباره تلاش کن",

                              });
                  });
    }
    function Cancelreservation(index,obj)
    {
        Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
            axios.post('{{route("work.res.cancel")}}', {RID:index})
                  .then(response => { 
                    if(response.data.success)
                    {
                        //if(response.data.b==0)
                        workReserveChange();
                        showMyReserves();
                    }
                        
                    else
                        Swal.fire({
                                  icon: 'error',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.message??' مشکل پیش آمده ',
                              });
                    })
                  .catch(error => {
                      console.log(error);
                      Swal.fire({
                                  icon: 'error',
                                  title: 'خطا',                        
                                  confirmButtonText: 'بله',
                                  //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                  html:"مشکل پیش آمده دوباره تلاش کن",

                              });
                  });
    }
    function showDives(hid,show,tit=0)
    {
        $(hid).hide();$(show).show(); 
        if(tit)
        title.querySelector('h6').innerText="رزرو های من";
        else
        title.querySelector('h6').innerText="رزرو فضای کاری"
         backurlIcon.classList.remove('d-none');
        backurlIcon.href="javascript:HideDives('"+hid+"','"+show+"'); "
    }
    function HideDives(hid,show)
    {
        $(hid).show();
         $(show).hide();
         title.querySelector('h6').innerText="فضای کاری"
         backurlIcon.href='{{route("home")}}';
         backurlIcon.classList.add('d-none');
    }
    function showMyReserves()
    {
        var totalHours =0;
        var myHours =0;
        Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
            axios.post('{{route("work.get")}}', {})
                  .then(response => { 
                    if(response.data.success)
                    {
                       
                        reserveDiv.innerHTML='';
                    response.data.data.forEach((item) => {
                    const date = new Date(item.Date);  
                    const today = new Date();  
                    
                    // Create the HTML output  
                    const itemDiv = document.createElement('div');  
                    itemDiv.className = 'col-12 d-flex';  
                    
                    const titleDiv = document.createElement('div');  
                    titleDiv.className = 'title2 py-4 px-3 rounded-circle d-grid';  
                    titleDiv.innerHTML = `<span>${date.toLocaleDateString('fa-IR', { weekday: 'long' })}</span>  
                                        <span>${date.toLocaleDateString('fa-IR-u-nu-latn', { year: 'numeric',month:'2-digit' ,day:'2-digit'})}</span>`;  
                    
                    itemDiv.appendChild(titleDiv);  
                    
                    const statusDiv = document.createElement('div');  
                    statusDiv.className = `align-items-center col d-flex justify-content-between p-2 title shadow ${item.Date < today.toISOString().split('T')[0] ? 'bg-secondary-subtle' : ''}`;  
                    /*if ([4,5].includes(parseInt(item.Status)))
                     statusDiv.className +='bg-danger-subtle';*/
                    const timeDiv = document.createElement('div');  
                    timeDiv.className = 'align-items-center col d-grid';  
                    switch (parseInt(item.Type)) {
                        case 3:
                        timeDiv.innerHTML = `<span>ساعت 15 الی 20</span>`;       
                            break;
                        case 4:
                        timeDiv.innerHTML = `<span>ساعت 11 الی 17</span>`;       
                            break;
                        case 8:
                        timeDiv.innerHTML = `<span>ساعت 10 الی 15</span>`;       
                            break;
                        case 7:
                        timeDiv.innerHTML = `<span>ساعت 10 الی 14</span>`;       
                            break;
                    }
                    statusDiv.appendChild(timeDiv);  

                    if (item.Status == 1 || item.Status == 3) {  
                        const label = document.createElement('label');  
                        label.className = 'd-grid label px-3 py-3 rounded-circle text-success';  
                        label.innerHTML = '<i class="fa fa-2x fa-circle-check"></i>';  
                        statusDiv.appendChild(label);  
                    
                        // Calculate hours if status is 1  
                        myHours +=Math.abs((new Date(date.toDateString()+' '+item.StartTime))-(new Date(date.toDateString()+' '+item.EndTime)))/  (1000 * 60 * 60);
                        //totalHours += Math.abs(checkOut - checkIn) / (1000 * 60 * 60); // convert milliseconds to hours  
                    } 
                    else if ([4,5].includes(parseInt(item.Status))) {  
                        const label = document.createElement('label');  
                        label.className = 'd-grid label px-3 py-3 rounded-circle text-danger';  
                        label.innerHTML = '<i class="fa fa-2x fa-triangle-exclamation"></i>';  
                        if (item.Status == 5)
                        label.innerHTML +="لغو شده";
                        else
                        label.innerHTML += 'انصراف';                       
                        statusDiv.appendChild(label);  
                    }
                    else if (item.Status == 0) {  
                        const label = document.createElement('label');  
                        label.className = 'btn-cancel c-pointer d-grid label p-3 rounded-circle';  
                        label.innerHTML = 'لغو';  
                        label.addEventListener('click', function()
                        {
                            Cancelreservation(item.Id,this);
                        });
                        statusDiv.appendChild(label); 
                    }else if (item.Status == 2) {
                                const label = document.createElement('label');
                                label.className = 'd-grid label px-3 py-3 rounded-circle text-danger';
                                label.innerHTML = '<i class="fa fa-2x fa-user-xmark"></i>';
                                label.innerHTML +="عدم حضور";
                                statusDiv.appendChild(label);
                            } 
                    if(!([4,5].includes(parseInt(item.Status))))
                    totalHours +=Math.abs((new Date(date.toDateString()+' '+item.StartTime))-(new Date(date.toDateString()+' '+item.EndTime)))/  (1000 * 60 * 60);

                    itemDiv.appendChild(statusDiv);  
                    reserveDiv.appendChild(itemDiv); // Append the itemDiv to the body or a specific container  
                  });
                  const remainingHoursDiv = document.createElement('div');  
                    remainingHoursDiv.className = 'col-12 d-flex';  
                    const remainingHoursItem = document.createElement('div');  
                    remainingHoursItem.className = 'align-items-center col justify-content-between p-4 title';  
                    remainingHoursItem.style.border = '1px dashed #343E66';  
                    remainingHoursItem.style.background = 'transparent';  
                    remainingHoursItem.innerHTML = `<span>شما ${myHours} ساعت  در فضای کاری اشتراکی حضور داشتید </span>  `;

                    remainingHoursDiv.appendChild(remainingHoursItem);  
                    reserveDiv.appendChild(remainingHoursDiv); // Append the remaining hours div to the body or a specific container  
                  swal.close();
                }
                        
                else
                    Swal.fire({
                                icon: 'error',                      
                                confirmButtonText: 'بله',
                                html:response.data.message??' مشکل پیش آمده ',
                            });
                })
                .catch(error => {
                    console.log(error);
                    Swal.fire({
                                icon: 'error',
                                title: 'خطا',                        
                                confirmButtonText: 'بله',
                                //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                html:"مشکل پیش آمده دوباره تلاش کن",

                            });
                });
    }
</script>
@endsection