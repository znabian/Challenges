@extends('layouts.goldchall')
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
            color: #8f8f8f;
            font-family:Peyda;
            font-size: 6pt;
            font-weight: 100;
        }
        .title
        {
            /*color: #676767;*/
            font-size: 9pt; 
            border-radius: 0 0 25px 25px;
            text-align: center;
            color: black;
            background: #f8f8f8;
            font-family: 'Peyda';
            font-weight: 400;

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
            height:unset!important;
        }
        .card-body
        {
            padding: 9px;
        }
    </style>
@endsection

@section('backUrl') 
{{route('gold.supervisor')}} 
@endsection
@section('content')  

<div id="content2" class="content2 " >    
    <div class="title col-md-12 h-auto m-auto pt-3 py-2 rounded-4 text-center" style="background-color: #ffffff8c;border: 4px double #75757533;font-size:10pt">
        کاخی که انتخاب کنی دارای چندین سرفصل است. کاخ موردعلاقه خودت رو انتخاب کن
        
    </div>            
    <div class="gap-3 gap-md-4 h-auto justify-content-center row m-md-auto">
     @if($castles->count())
            @foreach ($castles as $castle) 

            <div class="card col-5 col-md-4 mt-2 p-md-3 " onclick="location.href='{{route('gold.header',[$castle['AppId']])}}'">
                <div class="card-body d-grid gap-1 text-center">
                    <div class="">
                            <i class="c-pointer fa fa-arrow-left pull-left status" ></i>                       
                    </div>
                    <img src="{{$castle['Logo']}}" class="circle imgicon mx-auto shadow" alt="{{$castle['Castle']}}">
                       
                </div> 
                <div class="title p-2" >
                    <span>
                        {{$castle['Castle']}}
                    </span>
                </div> 
            </div>
            @endforeach
            
    @else
    <div>
        <p class="noinfo text-center">چالشی یافت نشد</p>
    </div>
    @endif

    </div>
</div>

         
@endsection