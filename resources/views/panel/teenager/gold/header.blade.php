@extends('layouts.goldchall')
@section('style')
<style>
    .selected
    {
        background-color: #f3efdc!important;
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
            margin: 8px  5px 0px 0px;
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
            font-size: 9pt; 
            /* line-height:0 !important; */
            font-family: 'PEYDA';
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
            /*height:67vh!important;*/
            height:unset!important;
        }
        .card-body
        {
            padding: 9px;
        }
    </style>
@endsection
@section('backUrl') 
{{route('gold.index')}}
@endsection
@section('content')  

<div id="content2" class="content2 " >   
    <div class="title col-md-12 h-auto m-auto pt-3 py-2 rounded-4 text-center" style="background-color: #ffffff8c;border: 4px double #75757533;">
        {{$app['Castle']}} که انتخاب کردی دارای چندین سرفصل است. سرفصل موردعلاقه خودت رو انتخاب کن
        
    </div>          
    <div class="gap-3 gap-md-4 h-auto justify-content-center row w-100 m-auto">
     @if($headers->count())
            @foreach ($headers as $castle)            

            <div class="c-pointer card col-12 mt-2 p-md-3 " onclick="document.querySelectorAll('.selected').forEach(itm=>{itm.classList.remove('selected')});this.classList.add('selected'); location.href='{{route('gold.subject',[$castle['Id']])}}'">
                <div class="card-body d-flex gap-1 text-right  align-items-center">
                    
                    <img src="{{asset('img/goldchall.svg')}}" class="imgicon rounded-2" alt="{{$castle['Castle']}}">
                       
                    <div class="title p-2" >
                        @php
                            $stringCut = substr($castle['Title'], 0, 500);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...';
                        @endphp     
                        @if(strlen($castle['Title'])>500) 
                        <p class="mx-3" id="limitsubj{{$castle['Id']}}">
                            {{$string}} <a class="c-pointer pull-left btn-link" onclick="limitsubj{{$castle['Id']}}.classList.add('d-none');allsubj{{$castle['Id']}}.classList.remove('d-none')">بیشتر</a>
                        </p>
                        <p class="mx-3 d-none" id="allsubj{{$castle['Id']}}">
                            {{$castle['Title']}}
                        </p>
                        @else
                        <p class="mx-3" id="allsubj{{$castle['Id']}}">
                            {{$castle['Title']}}
                        </p>
                        @endif
                    </div> 
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