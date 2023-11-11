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
            /* max-height: 170px; */
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
        /* } */
        .imgicon {
            width: 40px;
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
            font-size: 10pt; 
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
        .menu2
        {
            bottom: -12px!important;
        }
        
        .content2
        {
            height: auto!important;
            max-height:72vh;
        }
    </style>
@endsection
@section('title')  
پیام های من
@endsection
@section('content')  

<div id="content2" class="content2 gap-3 gap-md-4  justify-content-center row w-100 m-auto" >             
    @php
        $notifs=auth()->user()->MyNotifs()->get();
    @endphp        
     @if($notifs->count())
            @foreach ($notifs as $item) 
            <div class="card col-5 mt-2 p-md-3" onclick="location.href='{{$item->Link}}'">
                <div class="card-body d-grid gap-1 text-center">
                    <div class="">
                        @if(!$item->Seen)
                        <i class="fa fa-circle pull-left status" ></i>                                
                        @else
                        <i class="fa pull-left status"></i>
                        @endif
                    <img src="{{asset('img/child/home/notif.png')}}" class="imgicon" alt="">

                    </div> 
                            <div>
                                <span style="font-size: 8pt;">
                                    {!! $item->Body !!}
                                </span>
                                <br>
                                <span style="font-size: 7pt;font-weight: normal;color: #686da7;padding: 20px" class="pull-right">
                                    {!! jdate($item->Date)->format('d F ساعت  H:i')!!}
                                </span>
                            </div>                         
                                
                            <button class="btn-master fa fa-arrow-left-long pull-left m-auto"  onclick="location.href='{{$item->Link}}'"></button>
                </div>
            </div>
            @endforeach
            
    @else        
    <div>
        <p class="noinfo text-center">پیامی یافت نشد</p>
    </div>
    @endif
</div>
   @php
      DB::table('ReminderTbl')->where('UserId',auth()->user()->Id)->update(['Seen'=>1]);
   @endphp
   @include('layouts.menu3') 
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            notif.classList.add('d-none');
        });
        
    </script>
@endsection