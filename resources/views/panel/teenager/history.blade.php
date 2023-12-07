@extends('layouts.app')
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
            border: 1px solid #edc587;
            color: #616161;
            /* padding: 10px; */
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #00000078, 5px 5px 10px -4px #00000078;
            margin-bottom: 30px;
        }
        .noinfo
        {
            background: #f4f4f2;
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
            border: 1px solid #edc587;
            color: #616161;
            padding: 8%;
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            margin-top: 20%;
        }
        .btn-master
        {
            background:linear-gradient(to left, #C5AD76, #E2CBAC);/* linear-gradient(to left, #c5ae77, #dbc4a0);*/
            border: 1px solid #fff;
            border-radius: 15px;
            color: #fff;
            padding: 0px;
            width: 74px;
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
                background-color: #4c4c4c;
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size:13px;   
                border: none;
                font-weight: bolder;
                width: 23px;
                height: 23px;
            }
            i.status.fa-close
            {                
                /* color: #ffa1a3; */
                background-color: #757575!important;
            }
            i.status .fa-check
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
                    width: 40px!important;
                    /* font-size: 12pt!important; */
                    margin-left: 1px!important;
                    /* margin-top: 6px; */
                }
        /* } */
        .imgicon {
            width: 75px;
            height: 80px;
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
            font-size: 9pt;
            font-weight: 100;
        }
        .title
        {
            color: #676767;
            font-size: 12pt; 
            line-height:0 !important;
        }
        h6#title 
        {
        font-size: 16pt;
        margin-bottom: 0px !important;
        margin-top: -15px !important;
        }
        #content
        {
            background-image: url("{{asset('img/home/side.png')}}");
            background-size: 121px;
            background-repeat: no-repeat;
            background-position: left 113px;
            padding: 0!important;
            /* background-attachment:fixed; */
        }
        .circleImg {
                width: 73px;
                height: 73px;
                border-radius: 50%;
                background-color: #ffffff;
                color: #fff;
                position: absolute;
                top: 13px;
                right: 8px;
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
        #content2
            {
               padding: 12px 15px;
            }
    </style>
@endsection
@section('title')  
تاریخچه چالش ها
@endsection
@section('content')   
<div id="content2" class="content2">             
     @if($challs->count())
            @foreach ($challs as $item) 
            <div class="card mt-2 p-md-3" onclick="location.href='{{route('chall.details',[$item['Id']])}}'">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-2 m-auto mx-1" style="padding-right:5px !important;" >                                
                            @if($item['Options']??0)                   
                            <img src="{{asset('img/home/quiz.png')}}" class="imgicon" alt="{{$item['Type']}}">
                            @elseif(in_array($item['Type']??'text',['image','audio','text','movie']))                              
                            <img src="{{asset('img/home/'.$item['Type'].'.png')}}" class="imgicon" alt="{{$item['Type']}}">
                            @else
                            <img src="{{asset('img/home/text.png')}}" class="imgicon" alt="{{$item['Type']}}">
                            @endif
                            <span class="circleImg"></span>
                        </div>
                        <div class="col d-flex flex-column pt-0" style="border-right: 2px solid #edc587;margin-right: 16px;">
                            <div class="" style="margin-left: -2px;margin-top: -2px;">
                                @if($item['Done'])
                                <i class="fa fa-check pull-left status" ></i>
                                @elseif($item['Expired'])
                                <i class="fa fa-exclamation pull-left status" ></i>
                                @else
                                <i class="fa fa-close pull-left status"></i>
                                @endif
                            </div>
                            <div class="d-flex gap-2 flex-column mx-4" style="margin-right:0.25rem!important;">                                
                                <b class="h6 text-lg-end text-sm-center  title" >
                                    {{$item['Title']}}
                                </b>
                                <span class="subtitle">							
									@php
									$item['Body']= strtr($item['Body'],['%کاربر%'=> session('User')->Name]);
									@endphp
                                    {{ Str::limit($item['Body'], 30, '...')}}
                                </span>
                            </div> 
                            <div class="p-0">
                                
                                <span class="subtitle fw-bold">
                                    {{ltrim(jdate($item['ExpiredAt'])->format('d ام F ماه'),'0')}}
                                </span>
                                <button style="font-size: 9pt;"  class="btn-master fa fa-arrow-left-long pull-left p-1" onclick="location.href='{{route('chall.details',[$item['Id']])}}'">
                                
                                </button>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
            @endforeach
            
    @else
        <p class="text-center noinfo">چالشی یافت نشد</p>
    @endif
</div>

@include('layouts.menu3')          
@endsection