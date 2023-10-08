@extends('layouts.app')
@section('style')
    <style>
        #content
        {
            color: #fff;
            background-image: url("{{asset('img/home/back.png')}}");
            background-attachment: fixed;
            background-size: contain;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
        }
       /* .home
        {
            background-image: url("{{asset('img/home/mask.png')}}");
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100vh;
            opacity: 0.2;
            left: auto;
        }*/
        .card {
            background: linear-gradient(to right , #41467E, #23265B);
            border-radius: 25px;
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
            color: #fff;
            padding: 10px;
            font-weight: bolder;
            font-family: 'PEYDA-BLACK';
            box-shadow: -5px 0px 9px -3px #d2d3e38f, 5px 5px 10px 0px #1c1e3c;
            margin-bottom: 30px;
        }
        .btn-master
        {
            background: linear-gradient(274deg, #1b1d50, #333870);
            border: 2px solid #5c6096;
            border-radius: 15px;
            color: #686da7;
            padding: 0px;
            width: 74px;
            box-shadow: -5px 0px 4px -5px #d2d3e38f, 5px 5px 10px -3px #1c1e3c;
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
                    background-color: #3e427a;
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 15px;
                    font-family: 'Vazir';

                }
                .status {
                border-radius: 50%;
                background-color: #23265b;
                
                display: flex;
                justify-content: center;
                align-items: center;
                font-size:18px;   
                border: none;
                font-weight: bolder;
                width: 30px;
                height: 30px;
            }
            i.status.fa-close
            {                
                color: #ffa1a3;
            }
            i.status .fa-check
            {                
                color: #9effc2;
            }
            i.status .fa-exclamation
            {                
                color: #e9dd3d;
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
                    width: 60px!important;
                    /* font-size: 12pt!important; */
                    margin-left: 1px!important;
                    /* margin-top: 6px; */
                }
        /* } */
        .imgicon {
            width: 75px;
            height: 80px;
            border-radius: 11px;
        }
    </style>
@endsection
@section('content')   
<h6 class="mb-3 bold text-center" style="font-size: 18pt">چالش های امروز</h6> 
<div id="content2" class="content2">             
     @if($challs->count())
            @foreach ($challs as $item) 
            <div class="card mt-2 p-md-3" onclick="location.href='{{route('chall.details',[$item->Id])}}'">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-2 m-auto" >                                
                            @if(in_array($item->Chall->Type??'text',['image','audio','text']))                              
                            <img src="{{asset('img/home/'.$item->Chall->Type.'.png')}}" class="imgicon" alt="{{$item->Chall->Type}}">
                            @else
                            <img src="{{asset('img/home/text.png')}}" class="imgicon" alt="{{$item->Chall->Type}}">
                            @endif
                        </div>
                        <div class="col d-flex flex-column pt-0" >
                            <div class="" style="margin-left: -2px;margin-top: -2px;">
                                @if($item->Done)
                                <i class="fa fa-check pull-left status" ></i>
                                @elseif($item->Expired)
                                <i class="fa fa-exclamation pull-left status" ></i>
                                @else
                                <i class="fa fa-close pull-left status"></i>
                                @endif
                            </div>
                            <div class="d-flex gap-1 flex-column mx-4">                                
                                <b class="h6" style="font-size: 15pt;">
                                    {{$item->Chall->Title}}
                                </b>
                                <span style="font-family:Peyda;font-size: 8pt;font-weight: 100;">
                                    {{ Str::limit($item->Chall->Body, 47, '...')}}
                                </span>
                            </div> 
                            <div class="p-0">
                                <button class="btn-master fa fa-arrow-left-long p-1 pull-left" onclick="location.href='{{route('chall.details',[$item->Id])}}'">
                                
                                </button>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
            @endforeach
            
    @else
        <p class="text-center alert bg-2F3068">چالشی یافت نشد</p>
    @endif
</div>
@include('layouts.menu2')     
@endsection