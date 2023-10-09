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
            border-radius: 30px;
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
                color: #fb4f9c;
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
                    width: 45px!important;
                    font-size: 9pt!important;
                    margin-left: 1px!important;
                    /* margin-top: 6px; */
                }
        /* } */
        
    </style>
@endsection
@section('content')   
<h6 class="mb-3 bold text-center" style="font-size: 18pt; margin-bottom:0px !important; margin-top:-10px !important; ">پیام های من</h6> 
<div id="content2" class="content2">     
    @php
        $notifs=auth()->user()->MyNotifs()->get();
    @endphp        
     @if($notifs->count())
            @foreach ($notifs as $item) 
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
                                    {!! jdate($item->Date)->format('d F - H:i:s')!!}
                                </span>
                                <button class="btn-master fa fa-arrow-left-long pull-left"  onclick="location.href='{{$item->Link}}'">
                                
                                </button>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
            @endforeach
            
    @else
        <p class="text-center alert bg-2F3068">پیامی یافت نشد</p>
    @endif
</div>
   @php
      DB::table('ReminderTbl')->where('UserId',auth()->user()->Id)->update(['Seen'=>1]);
   @endphp
   @include('layouts.menu2') 
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            notif.classList.add('d-none');
        });
        
    </script>
@endsection