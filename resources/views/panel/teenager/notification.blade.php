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
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
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
            background: linear-gradient(to left, #c5ae77, #dbc4a0);
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
                /* background-color: #23265b; */
                
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 15px;   
                border: none;
                font-weight: bolder;
                width: 30px;
                height: 30px;
            }
            i.status.fa-circle
            {                
                color: #10df39;
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
            background-size: 30vw;
            background-repeat: no-repeat;
            background-position: left 113px;
            padding: 0!important;
            /* background-attachment:fixed; */
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
        .menu2
        {
            bottom: 0px!important;
        }
    </style>
@endsection
@section('title')  
پیام های من
@endsection
@section('content')   
<div id="content2" class="content2">           
     @if($notifs->count())
            @foreach ($notifs as $item) 
            @php
                $item = (object)($item);
            @endphp
            <div class="card mt-2 p-md-3" onclick="location.href='{{$item->Link}}'">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-1 m-auto" style="padding-right:5px !important;" >                               
                                <span class="circle"><i class="fa fa-bell"></i></span>
                        </div>
                        <div class="col d-flex flex-column" >
                            <div class="p-0">
                                @if(!$item->Seen)
                                <i class="fa fa-circle pull-left status" ></i>                                
                                @else
                                <i class="fa pull-left status"></i>
                                @endif
                            </div>
                            <div class="d-flex gap-1 flex-column mx-4" style="padding-right:15px;">                            
                                <span style="font-size: 8pt;">
                                    {!! $item->Body !!}
                                </span>
                                <span style="font-size: 5pt;font-weight: normal;">
                                    
                                </span>
                            </div> 
                            <div class="p-0">
                                <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                                    {!! ltrim(jdate($item->Date)->format('d F - H:i:s'),'0')!!}
                                </span>
                                <button class="btn-master fa fa-arrow-left-long pull-left p-1"  onclick="location.href='{{$item->Link}}'">
                                
                                </button>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
            @endforeach
            
    @else
        <p class="text-center text-center noinfo">پیامی یافت نشد</p>
    @endif
</div>
   @include('layouts.menu3') 
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            notif.classList.add('d-none');
        });
        
    </script>
@endsection