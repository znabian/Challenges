@extends('layouts.childApp')
@section('style')
<style>
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
                /*background-color: #727272!important;*/
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
            width: 42px;
            height: auto;
            margin: 0 auto;
        
        }
        .subtitle
        {
            color: #8f8f8f;
            font-family:Peyda;
            font-size: 6pt;
            font-weight: 100;
        }
        .title
        {
            color: #676767;
            font-size: 8pt; 
            /* line-height:0 !important; */
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
            background-image: url("{{asset('img/child/home/back.png')}}");
            background-color: #f6f6f6;
            background-blend-mode: darken;
        }
        body
        {
            background-color: #f6f6f6;
        }
        .content2
        {
            max-height:67vh!important;
        }
        .card-body
        {
        padding: 9pt;
        }
        select#filterChalls {
            font-size: 9pt;
            font-family: 'Peyda';
        }
       .offer {
        background: linear-gradient(228deg,#f76801,#dc5507);
        border-radius: 0 0 25% 25%;
        padding: 4%;
        margin-top: -0.75rem;
        margin-left: 8px;
        height: 2rem;
        width: 2rem;
        border: 1px dotted #dc5507;

        }
    </style>
@endsection
@section('title')  
بازارچه
@endsection
@section('subtitle')  
<h6>
    <select id="filterChalls" onchange="showList(this.value)" class="bg-body-secondary form-control text-center">
        <option value="card">همه </option> 
        <option value="Doned">انجام شده </option> 
        <option value="Payed">انجام نشده </option>
        <option value="Other">شرکت نکرده </option>
    </select>
</h6>
@endsection
@section('content')  

<div id="content2" class="content2" >             
    <div id="PayChallsList" class="gap-3 gap-md-4  justify-content-center row w-100 m-auto">
     @if($challs->count())
            @php
            $current=now();//date_create(date('Y-m-d H:i:s'));
            $startdate=date_create('2024-10-22 00:00:00');
            $enddate=date_create('2024-11-01 00:00:00');
            @endphp
            @foreach ($challs as $item) 
            <div class="card col-5 mt-2 p-md-3 @if($item['Status']==5) bg-danger-subtle Doned @elseif($item['Done']) bg-success-subtle Doned @elseif($item['Pay']) Payed @else Other @endif " onclick="location.href='{{route('chall.details',[$item['Id']])}}'">
                <div class="card-body d-grid gap-1 text-center">
                    <div class="">
                        @if($item['Status']==5)
                            <i class="fa fa-close pull-left status "></i>
                        @elseif($item['Done'])
                            <i class="fa fa-check pull-left status" ></i>
                        @elseif($item['Pay'])
                            <i class="fa fa-coins pull-left status" ></i>
                        @else
                        
                            @php
                               /*
                                $spd= date_diff(date_create(session('User')->CallTime),now())->format("%R%a");
                                $f=$spd-$item['Level'];
                                */
                                $f= date_diff(date_create(explode(' ',$item['ExpiredAt'])[0]),date_create(date('Y-m-d')))->format("%R%a");

                                $price=$item['Price']+(($f>2)?$f-2:0)*10000;
                                if($price>50000)
                                $price=50000;  
                            @endphp
                            @if($current->between($startdate,$enddate) && $price==50000)
                            <i class="offer pull-left status" >70%</i>
                            @else
                            <i class="fa fa-close pull-left status opacity-0"></i>
                            @endif                            
                        @endif
                    </div>
                        
                        
                        @if($item['Options']??0)                   
                            <img src="{{asset('img/child/home/quiz.png')}}" class="imgicon" alt="{{$item['Type']}}">
                            @elseif(in_array($item['Type']??'text',['image','audio','text','movie']))                              
                            <img src="{{asset('img/child/home/'.$item['Type'].'.png')}}" class="imgicon" alt="{{$item['Type']}}">
                            @else
                            <img src="{{asset('img/child/home/text.png')}}" class="imgicon" alt="{{$item['Type']}}">
                        @endif
                        <b class="title " >
                            {{$item['Title']}}
                        </b>
                        <span class="subtitle">							
                            @php
                            $item['Body']= strtr($item['Body'],['%کاربر%'=> session('User')->Name]);
                            @endphp
                            {{ Str::limit($item['Body'], 26, '...')}}
                        </span>
                        
                        <span class="subtitle fw-bold">
                            {{ltrim(jdate($item['ExpiredAt'])->format('d ام F ماه'),'0')}}
                        </span>
                        <button style=""  class=" btn-master fa fa-arrow-left-long pull-left m-auto" onclick="location.href='{{route('chall.details',[$item['Id']])}}'"></button>
                </div>  
            </div>
            @endforeach
            
    @else        
    <div>
        <p id="pNochall" class="noinfo text-center">چالشی یافت نشد</p>
    </div>
    @endif

    </div>
</div>

@include('layouts.menu4')          
@endsection
@section('script')
<script>
     filterChalls.querySelectorAll('option').forEach(itm=>{
    itm.text=itm.text+" ("+PayChallsList.querySelectorAll('.card.'+itm.value).length+")";
  });
    function showList(value)
  {
    if(PayChallsList.querySelector('#pNochall'))
    PayChallsList.querySelector('#pNochall').remove();

    PayChallsList.querySelectorAll('.card').forEach(item=>{item.classList.add('d-none')});
    PayChallsList.querySelectorAll('.card.'+value).forEach(item=>{item.classList.remove('d-none')});
    if(PayChallsList.querySelectorAll('.card.'+value).length<1)
    {
      if(!PayChallsList.querySelector('#nochalls'))
      {
        var pNochall=document.createElement('p');
        pNochall.className="noinfo text-center";
        pNochall.innerHTML="چالشی یافت نشد";
        pNochall.id='pNochall';
        PayChallsList.appendChild(pNochall);
      }
      
    }
  }
</script>
@endsection