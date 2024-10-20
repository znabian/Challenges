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
            background: #f4f4f2;
        border-radius: 25px;
        border: unset;
        /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
         /*border: 1px solid #edc587;*/
        color: #616161;
        /* padding: 10px; */
        font-weight: bolder;
        font-family: 'PEYDA-BLACK';
        box-shadow: -3px 0px 7px -3px #00000078, 5px 5px 10px -4px #00000078;
        margin-bottom: 30px;
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
            width: 60px;
            height: 70px;
            border-radius: 11px;
            /* transform: scaleX(-1); */
            z-index: 1;
            position: absolute;
            top: 11px;
    }
    .subtitle
    {
        color: #8f8f8f;
        font-family:Peyda;
            font-size: 8pt;
        font-weight: 100;
    }
    .title
    {
        color: #676767;
            font-size: 12pt; 
            line-height:1 !important;
        }
        h6#title 
        {
        font-size: 16pt;
        margin-bottom: 0px !important;
        margin-top: -15px !important;
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
        width: 35px;
        height: 35px;
            border-radius: 50%;
        background-color: #edc587;
        color: #4c4c4c;
            position: absolute;
            top: 13px;
        right: auto;
        text-align: center;
        justify-content: center;
        display: flex;
        align-items: center;
        font-size: 10pt;
        font-family: 'FontAwesome';
        border: 3px solid;
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
        height:70vh!important;
    }
    #rnktit
    {
        font-size: 8pt;
    }
    
</style>
@endsection
@section('title')  
رتبه بندی
@endsection
@section('subtitle')  
<h6 id="rnktit">
    رتبه کل در چالش های فرست کلاس 
</h6>
@endsection
@section('content')   
<div id="content2" class="content2"> 
    <div id="allrank" class="tabrnk overflow-y-auto p-2" style="height:88%;">
            @foreach ($ranks->take(20) as $item) 
            <div class="card mt-1 p-md-3 @if($item['Id']==$user->Id) d-none  @endif " @if($item['Id']==$user->Id) id="mrank_all" @endif >
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >                                
                            <span class="circleImg" > {{$item['rank']}}</span>
                        </div>
                        <div class="col d-flex flex-column pt-0" style="margin-right: 16px;">
                            
                                <b class="h6  text-center  title" >
                                    {{$item['FullName']}}
                                </b>
                                <b class="text-center   subtitle" >
                                    {{number_format($item['wallet'])}} تومان
                                </b>
                            
                        </div>
                        <div class="d-none col-2 d-grid flex-column pt-0" style="margin-right: 16px;">
                    
                            <b class="ltr  subtitle" >
                                <i class="fa fa-wallet" style="font-size:8pt"></i> {{number_format($item['wallet'])}}
                             </b>
                             <b class="ltr  subtitle" >
                                <i class="fa fa-medal" style="font-size:8pt"></i> {{number_format($item['Challs'])}}
                             </b>
                        
                        </div>                 
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div id="cityrank" class="tabrnk overflow-y-auto p-2" style="height:88%;display:none;">
            @foreach ($Cityranks->take(20) as $item) 
            <div class="card mt-1 p-md-3 @if($item['Id']==$user->Id) d-none  @endif " >
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >                                
                            <span class="circleImg" @if($item['Id']==$user->Id) id="mrank_city" @endif > {{$item['rank']}}</span>
                        </div>
                        <div class="col d-flex flex-column pt-0" style="margin-right: 16px;">
                            
                                <b class="h6  text-center  title" >
                                    {{$item['FullName']}}
                                </b>
                                <b class="text-center   subtitle" >
                                    {{number_format($item['wallet'])}} تومان
                                </b>
                            
                        </div>
                        <div class="d-none col-2 d-grid flex-column pt-0" style="margin-right: 16px;">
                    
                            <b class="ltr  subtitle" >
                               <i class="fa fa-wallet" style="font-size:8pt"></i> {{number_format($item['wallet'])}}
                            </b>
                            <b class="ltr  subtitle" >
                               <i class="fa fa-medal" style="font-size:8pt"></i> {{number_format($item['Challs'])}}
                            </b>
                        
                        </div>                 
                    </div>
                </div>
            </div>
            @endforeach
    </div>

</div>
<div id="mrankdiv" class="menu2" style="@if($mycity) bottom: 43px; @else bottom: 8px; @endif width: calc(53vw - 10vw);right: calc(43vw - 15vw);">
    
    <div class="card mt-1 p-md-3 " style="background-color: #f9d8a4;border:1px solid #4c4c4c;" >
        <div class="card-body">
            <div class="row d-flex">
                <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >                                
                    <span class="circleImg mrank" id="mrankall"> {{$myRank->rank}}</span>
                    <span class="circleImg mrank" id="mrankcity" style="display: none;"> {{$myRankCity->rank}}</span>
                </div>
                <div class="col d-flex flex-column pt-0" style="margin-right: 16px;">
                    
                        <b class="h6  text-center  title" >
                            {{$myRank->FullName}}
                        </b>
                        <b class="text-center   subtitle" >
                            {{number_format($myRank->wallet)}} تومان
                        </b>
                    
                </div>
                <div class="d-none col-2 d-grid flex-column pt-0" style="margin-right: 16px;">
                    
                        <b class="ltr  subtitle" >
                           <i class="fa fa-wallet" style="font-size:8pt"></i> {{number_format($myRank->wallet)}}
                        </b>
                        <b class="ltr  subtitle" >
                           <i class="fa fa-medal" style="font-size:8pt"></i> {{number_format($myRank->Challs)}}
                        </b>
                    
                </div>                
            </div>
        </div>
    </div>
  
</div>

@if($mycity)
<div class="d-flex justify-content-center menu2" style="bottom:8px">
    
  <nav class="" >
    <ul class="d-flex justify-content-around list-inline p-1 position-relative">
     
      <a id="rankall" onclick="$('.mrank').hide();$('#mrankall').show();$('.tabrnk').hide();$('#allrank').show();rankcity.classList.remove('active');rankall.classList.add('active');rnktit.innerHTML='رتبه کل در چالش های فرست کلاس'" class="c-pointer  active text-decoration-none">
        <li>
            <i class="fa fa-ranking-star"></i>
            کل
        </li>
      </a>   
      <a id="rankcity" onclick="$('.mrank').hide();$('#mrankcity').show();$('.tabrnk').hide();$('#cityrank').show();rankcity.classList.add('active');rankall.classList.remove('active');rnktit.innerHTML='رتبه در استان {{$mycity}}'" class="c-pointer text-decoration-none" >
        <li class="">
            <i class="fa fa-chart-simple"></i>
            استانی
        </li>
      </a>
    </ul>
  </nav>
  
</div>
@endif
       
@endsection
@section('script')
<script>
   
</script>
@endsection