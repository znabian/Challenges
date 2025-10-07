
@extends('layouts.childApp')
@section('style')   
<style>
  video
  {
    object-fit: fill;
  }
/* .container {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
} */
.btn-master {
    background: linear-gradient(to left, #7a7a7a, #444444);
    border: 1px solid #fff!important;
    border-radius: 14px!important;
    color: #fff!important;
    padding: 8px!important;
    width: 125px;
    font-size: 12pt!important;
    /* display: block!important; */
    /* margin: 10px auto!important; */
    /* margin-bottom: 0!important; */
}
#content {
            color: #535353;            
            /* max-height: 100vh; */
            /* height: 88vh; */
            /* min-height: 100%; */
            padding: 4vw;
            overflow: hidden;
           
        }
    
/* .row {
  margin-bottom: 20px;
}

.col-12 {
  width: 100%;
}

.col-md-6 {
  width: 50%;
} */
.divEarth {
    top: -151px;
    position: relative;
}
.earth {
    max-width: 12rem!important;
    /* max-width: 150%!important; */
    height: auto;
    /* position: relative;
    right: -83px; */
    /* top: -118px; */
    /* max-width: 1009px; */
    /* rotate: 342deg; */
}
.bodyChall
{
    position: relative;
    top: -103px;
}
.challFile{
    position: relative;
    /* top: -67px;     */
}
.text-title {
    /* position: relative;
    top: -103px; */
    /* opacity: 0.25; */
    color: #86827e;
    font-weight: 900;
    font-family:'PEYDA-BLACK';
    font-size: calc(2.5rem + 1.5vw);
}
.text-subtitle {
    /* position: relative;
    top: -103px; */
    font-weight: 900;
    color: #535353;
    font-size: calc(1.65rem + 1vw);
    /* padding-inline-start: 14px;
    margin-right:65px; */
    /* text-shadow: 2px 3px 3px #323030ad; */
}

.cardChall {
    font-size: 12pt;
    font-family: Peyda;
    line-height: 25px;
    text-align: justify;
    color: #838383;
}

.card-body {
    /* padding: 25px; */
    font-family: Peyda;
}

.card-body p {
  /* line-height: 1.5; */
    /* line-height: 20px; */
    color: black;
}

.challVideo {
    width: 75%;
    border-radius: 25px;
    padding: 11px;
    height: 22vh;
    text-align: center;
        
    }
.challImg{
    border-radius: 25px;
    /* padding: 11px; */
    /* width: 98%; */
    height: 100%;
    box-shadow: 0 0 14px -1px #50558c;
    opacity: 0.8;
}
    
.overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #4e4e4e78;
    width: 75%;
    height: 100%;
    justify-content: center;
    display: flex;
    border-radius: 21px;
    padding-top: 20%;
}

.overlay a {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 50px;
  /* background-color: rgba(0, 0, 0, 0.5); */
  border-radius: 50%;
  color: white;
  text-decoration: none;
}

.overlay a i {
  font-size: 24px;
}
#content
        {
       
        padding: 0!important; 
        /* background-image: url("{{asset('img/details/back.png')}}");
        background-size: cover;
        background-attachment: fixed; */
        background-color: #fff!important;
        /* height: 100vh!important; */
        }
        @media (min-width: 760px)
        {
            #content
            {
                width: 100%!important;
            }
            .playicon
             {
             opacity:1!important;
            }
            .backcircle
             {
             opacity:0!important;
            }
            .backimg {
                background-position: left 50vh!important;
                background-size: 17vw!important;
                background-attachment: scroll!important;
            }
        }

.picfile {
    background-size: cover;
    background-repeat: no-repeat;
    height:13rem;/* 154px;*/
    background-color: #4e4e4e91;
    background-blend-mode: darken;
    width: 100%;
    border-radius: 23px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 6px 10px -5px #1a18188f;
}
.playicon {
    /* position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); */

    cursor: pointer;
  position: absolute;
  background-image: url('{{asset("img/details/play.png")}}');
  background-repeat: no-repeat;
  background-size: 100%;
  background-position: center center;
  width: 70px;
  height: 70px;
  z-index: 100;
  display: block;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  opacity:1;
  /* background-color: #df394b;
  border-radius: 50%;
  transition: all 0.3s ease !important;
  box-shadow: 0px 2px 4px #b10013; */
}
.blurEffect{
  filter: opacity(0.5);
    background-color: #4e4e4e91;
}
.backcircle {
    position: absolute;
    background-image: url('{{asset("img/child/home/tring.png")}}');
    background-repeat: no-repeat;
    background-size: 80%;
    background-position: 125px -1px;
    width: 100%;
    height: 350px;
    display: block;
    /* margin-right: -308px; */
    /* opacity: 0.6; */
    justify-content: center;
    z-index: 0;
}
.waveplayer {
    width: 100%;
    height: 58px;
    /* border: 9px solid white; */
    border-radius: 15px;
    padding: 5px;
    box-shadow: 0px 3px 5px 0px #c5c5c5;    
    position: relative;
    /* overflow-x: hidden; */
}
.wave {
    width: 95%;
    height: 59px;
    /* background-image: url('{{asset("img/player/wave.jpg")}}'); */
    background-size: 28px;
    background-position: center;
    background-repeat-y: no-repeat;
    background-blend-mode: screen;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    background-color: #fefefe94;
    position: absolute;
    bottom: 0;
    border-radius: 15px;
}
.unplayed
{
    background-image: url('{{asset("img/player/wave.png")}}');
    left: 0;
    background-position: 1px center;
    width: 95%;
    height: 59px;
    background-size: 28px;
    background-repeat-y: no-repeat;
    background-blend-mode: screen;
    background-color: #fefefe94;
    position: absolute;
    bottom: 0;
    border-radius: 15px;
}
.played {
    width: 0%;
    /* float: left; */
    height: -webkit-fill-available;
    background-image: url('{{asset("img/player/wave.png")}}');
    background-size: 28px;
    background-position: left;
    background-repeat-y: no-repeat;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    /* background-color: red; */
    position: absolute;
    left: 0;
    /* height: 57px; */
    bottom: 4%;
    margin-left: 0;
}
.circleplay {
                width: 54px;
                height: 50px;
                border-radius: 50%;
                background-color: #ffffff;
                /* color: #fff; */
                /* position: absolute;
                top: 13px;
                right: 4px; */
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 15px;
                box-shadow: 0px 3px 5px 0px #c5c5c5;
                cursor: pointer;
            }
            .progress
             {
                width: 101%;
                margin-bottom: -40px;
                padding: 12px;
                direction: ltr;
                opacity: 0; 
                cursor: pointer;
                position: absolute;
                bottom: 100%;
                z-index: 1;
            }
          .backimg 
           {
              height: 80vh;  
              @if(in_array($chall->Type??'text',['image','movie','audio']))
              background-image: url("{{asset('img/child/detailes/'.($chall->Type??'image').'.png')}}");
              @else
              background-image: url("{{asset('img/child/detailes/image.png')}}");
              @endif
              background-repeat: no-repeat;
             /* background-position: -20% 130%;
              background-size: 79%;*/  
             background-position: -20% 74vh;
              background-size: 59%;  
              background-attachment: fixed;         
          }
.timeline
{
  display: block!important;
  font-weight: bold;
}
.priceDiv
{
  @if(!$chall->Pay)
  border:2px solid #939393;
  @endif  
  font-size: 9pt;
  align-items: center;
  padding-block: 1px;
  justify-content: space-between;
}
.priceDiv span
{
  color: #7e7e7e;
  font-family: 'PEYDA-BLACK';
  font-size: 7pt;  
}
#Paybtn
{
  font-size: 9pt;  
  box-shadow: 4px 3px 10px -3px #000;
  padding-block: 3px;
  @if($chall->Pay)
  background: #F8E7B0;
  @else
  background: #00772D;
  color: #fff;
  @endif
  cursor: pointer; 
}
.audio-caption
{
  position: static;
  padding: 0;
  color: #3b407a;
  text-align: center!important;
}
.status {
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
.offer {
        background: linear-gradient(228deg,#f74701,#dc5507);
        border-radius: 0 0 25% 25%;
        padding: 3%;
        margin-top: -1rem;
        margin-left: 8px;
        height: 0.5rem;
        width: 0.5rem;
        border: 1px dotted #dc5507;

        }
</style>
@endsection
@section('content')   

    <div class="col-12 overflow-x-hidden overflow-y px-3 backimg position-relative"  style="height: 74vh">
      <div class="col-12 d-flex px-2 pb-1">
        <span class="col small" style="font-family: 'Peyda'">تاریخ چالش:</span>
        <div class="d-flex gap-2 small"  style="margin-left:-5px">
          <div class="d-flex flex-row-reverse gap-1 small">
            <i class="fa opacity-75 fa-calendar-minus fa-regular"></i>
            <span class="text-danger">{{jdate($chall->ExpiredAt)->format('y/m/d')}}</span>
          </div>
          <div class="d-flex flex-row-reverse gap-1 small">
            <i class="fa opacity-75 fa-calendar-plus fa-regular"></i>
            <span>{{jdate($chall->Date)->format('y/m/d')}}</span>
          </div>
        </div>
      </div>
      <div class="d-flex  ">
        <img src="{{asset('img/child/home/tring.png')}}" style=" margin-right:-10px" class="h-25 col-2 opacity-50" alt="">
        <img src="{{asset('img/child/challenge.png')}}" style="width:150px;height:170px">
        <div class="m-auto">
          <h1 class="mt-5 text-right text-title" >چالش</h1>
        </div>
         
      </div>
      <div class="d-flex justify-content-center mt-2">
         
          <h2 class=" text-subtitle "  >
            {{$chall->Title}}
          </h2>
      </div>
      <div class="ChallFile px-3">        
        @php
            $chall->File=strtr($chall->File,['http://85.208.255.101:8012/'=>'https://www.kakheroshd.ir:448/','http://185.116.161.39:8012/'=>'https://www.kakheroshd.ir:448/','http://dl5.erfankhoshnazar.ir/'=>'https://www.kakheroshd.ir:448/','http://dl4.erfankhoshnazar.com/'=>'https://www.kakheroshd.ir:448/RedCastleFileManager/']);            
        @endphp
        @if($chall->Link)
        <div id="carouselExample" class="carousel slide" data-bs-interval="false" >
          <div class="carousel-inner">
            @if($chall->File)
            <div class="carousel-item active">
              <div class="col-12 d-flex gap-2 justify-content-center mt-3">
                @if($chall->Type=='movie')
                <div class="col-12 position-relative">
                  <video  poster="{{asset('img/cover.png')}}" class="videoRes embed-responsive-16by9 picfile" oncontextmenu="return false;"  controlsList="nodownload"  >
                  <source data-src="{{$chall->File}}" type="video/mp4">
                </video>
                <span class="playicon"></span>
                </div>
                
                @elseif($chall->Type=='audio')
                <audio class="d-none sounds" controlsList="nodownload" controls src="{{$chall->File}}" >
                </audio>
                @include('panel.audioplayer') 
                @elseif($chall->Type=='image')
                <div class="picfile" style="background-image: url({{$chall->File}})">
                  <a href="{{$chall->File}}" target="_blank" download>
                    <img src="{{asset('img/details/download.png')}}" alt="Image" width="70" height="70">
                    </a>
                </div>
                @endif
              </div>
            <div class="carousel-caption @if($chall->Type=='audio') audio-caption @endif bottom-0">
              <p>پیوست 1</p>
            </div>
            </div>
            @endif
            @foreach(json_decode($chall->Link) as $id=>$link)
            @php
            $link->Link=strtr($link->Link,['http://85.208.255.101:8012/'=>'https://www.kakheroshd.ir:448/','http://185.116.161.39:8012/'=>'https://www.kakheroshd.ir:448/','http://dl5.erfankhoshnazar.ir/'=>'https://www.kakheroshd.ir:448/','http://dl4.erfankhoshnazar.com/'=>'https://www.kakheroshd.ir:448/RedCastleFileManager/']);
            @endphp
            <div class="carousel-item  @if(!$chall->File && $loop->first) active @endif ">
              <div class="col-12 d-flex gap-2 justify-content-center mt-3">
                @if($link->Type=='movie')
                <div class="col-12 position-relative">
                  <video  poster="{{asset('img/cover.png')}}" class="videoRes embed-responsive-16by9 picfile" oncontextmenu="return false;"  controlsList="nodownload"  >
                  <source data-src="{{$link->Link}}" type="video/mp4">
                </video>
                <span class="playicon"></span>
                </div>
                
                @elseif($link->Type=='audio')
                <audio class="d-none sounds" controlsList="nodownload" controls src="{{$link->Link}}" >
                </audio>
                @include('panel.audioplayer') 
                @elseif($link->Type=='image')
                <div class="picfile" style="background-image: url({{$link->Link}})">
                  <a href="{{$link->Link}}" target="_blank" download>
                    <img src="{{asset('img/details/download.png')}}" alt="Image" width="70" height="70">
                    </a>
                </div>
                @endif
              </div>
              <div class="carousel-caption @if($link->Type=='audio') audio-caption @endif bottom-0">
                @if($chall->File) 
                <p>پیوست {{$id+2}}</p>
                @else           
                <p>پیوست {{$id+1}}</p>
                @endif
              </div>
            </div>
            @endforeach


            
            
            
          </div>
          {{-- <button class="carousel-control-prev" onclick="playpause();" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="fa fa-2x fa-circle-arrow-left text-dark " aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button> --}}
          @if(count(json_decode($chall->Link))>1 || $chall->File && count(json_decode($chall->Link))>0)
          <button class="carousel-control-next" onclick="playpause();" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="fa fa-2x fa-circle-arrow-right text-dark" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
          @endif
        </div>
       @else
        <div class="col-12 d-flex gap-2 justify-content-center mt-3">
          @if($chall->Type=='movie')
          <div class="col-12 position-relative">
            <video  poster="{{asset('img/cover.png')}}" class="videoRes embed-responsive-16by9 picfile" oncontextmenu="return false;"  controlsList="nodownload"  >
            <source data-src="{{$chall->File}}" type="video/mp4">
          </video>
          <span class="playicon"></span>
          </div>
          
          @elseif($chall->Type=='audio')
          <audio class="d-none sounds" controlsList="nodownload" controls src="{{$chall->File}}" >
          </audio>
          @include('panel.audioplayer') 
          @elseif($chall->Type=='image')
          <div class="picfile" style="background-image: url({{$chall->File}})">
            <a href="{{$chall->File}}" target="_blank" download>
              <img src="{{asset('img/details/download.png')}}" alt="Image" width="70" height="70">
              </a>
          </div>
          @endif
        </div>
        @endif
      </div>
      <div class="col-12 mt-4 px-3">
        @if($chall->Body)
        @php
        $chall->Body=strtr($chall->Body,['%کاربر%'=> session('User')->Name]);
        $chall->Body=strtr($chall->Body,["\n"=>"<br>"]);
        if(!$chall->Done)
        $chall->TimeLine="<span class='timeline'>یادت باشه فقط تا ".jdate($chall->ExpiredAt)->format('d ام F ماه')." فرصت داری این چالش رو انجام بدی</span>";
        @endphp
        <div class="cardChall" >
          <div class="card-body">
            @if(in_array(($chall->Type??'text'),['image','movie','audio']) || !$chall->Options??0)
              @if(strlen(strip_tags($chall->Body))>200) 
              <p id="mintxt">
                  {!!Str::limit(strip_tags($chall->Body), 200, ' ... ')!!} <a class="c-pointer btn-link" onclick="mintxt.classList.toggle('d-none');fulltxt.classList.toggle('d-none')">بیشتر</a>
              </p>
              <p id="fulltxt" class="d-none">{!!$chall->Body!!}</p>
              @else
              <p> {!!$chall->Body!!}</p>
              @endif
            @else
            <p> {!!$chall->Body!!}</p>
            @endif
              @php
                  $num=['first'=>'الف','second'=>'ب','third'=>'ج','forth'=>'د','fifth'=>'ه','sixth'=>'و'];
                  $answers=json_decode($chall->Options??'[]');
              @endphp
            @if($answers)
            <p class="row small" id="optionsBox">
              @foreach ($answers as $index=>$opt)
                @if($index!='ans')
                <label for="" class="col-12 gap-1">
                  @if($chall->Closed??0 ) 
                  <i class="fa  fa-regular my-auto @if($answers->ans==$opt || ($answers->ans==$opt && $chall->MyAnswer==("پاسخ این سوال  ".$opt." است"))) fa-circle-check @elseif($chall->MyAnswer==("پاسخ این سوال  ".$opt." است")) fa-circle-xmark  @else fa-circle @endif " ></i>
                  @elseif(!$chall->Pay) 
                  <i  class="fa fa-circle fa-regular my-auto"  ></i>
                  @else 
                  <input type="radio" name="Answer" id="answer" @if($chall->MyAnswer==("پاسخ این سوال  ".$opt." است")) checked  @endif  value="{{$opt}}">                  
                  @endif
                  {{$num[$index].') '.$opt}}
                  </label> 
                @endif  
              @endforeach  
              <div class="d-flex justify-content-center">
                <button onclick="setAnswer(this)" class="btn btn-master  @if(($chall->Pay??0)<0 || ($chall->Closed??0) ) d-none @endif ">ثبت پاسخ</button>
              </div>                
                
            </p>
            @endif  
                       
            
          </div>
        </div>
        @endif
      </div>
      @if($chall->Type=='archive')
      <div class="d-flex justify-content-center col-12">
        <a href="{{$chall->File}}"  target="_blank" download class="btn btn-master  ">دانلود فایل</a>
      </div>  
      @endif
    </div>
      <div class="position-relative row px-3 justify-content-center mx-auto">
        <div id="payCard" class=" card justify-content-center  mx-auto overflow-hidden position-fixed rounded-4 col-11 col-md-5 @if($chall->Pay) bg-success text-white @endif"  style="bottom:-10px;z-index: 350;font-size: 9pt;height:40px">
          
          <div id="unpay" class=" @if($chall->Pay) d-none @endif align-items-center card-body d-flex gap-3 justify-content-center" style="">

              
              @php
              /*
              $spd= date_diff(date_create(session('User')->CallTime),now())->format("%R%a");
              $f=$spd-$chall->Level;
              */              
              $f= date_diff(date_create(explode(' ',$chall->ExpiredAt)[0]),date_create(date('Y-m-d')))->format("%R%a");
              
              $price=$chall->Price+(($f>2)?$f-2:0)*10000;
              if($price>50000)
              $price=50000;
            
              $current=now();//date_create(date('Y-m-d H:i:s'));
              $startdate=date_create('2024-10-22 00:00:00');
              $enddate=date_create('2024-11-01 00:00:00');

              $discount=false;
              if($current->between($startdate,$enddate) && $price==50000)
              {
                $price=15000;
                $discount=true;
              }
            @endphp
            @if($discount)
            <i class="offer status" >70%</i>
            @endif
            @if($chall->Auto)
            <i class="fa fa-arrow-left-long text-danger"></i>
            <span class="">پاداش چالش:</span>
            @if($discount)
            <div class="d-grid" style="line-height:9px">
              <b class=" text-danger">{{number_format(60000-$price)}}</b>
              <small class="text-decoration-line-through">{{number_format(60000-50000)}}</small>
            </div>
            
            @else
              <b class="">{{number_format(60000-$price)}}</b>
            @endif
              
              <span class="">تومان</span>
              <button  onclick="buyChall(1)" class="align-items-center btn btn-success col-3 d-flex fw-bold gap-2 justify-content-center py-1 rounded" style="font-size: 10pt;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13.283" height="9.66" viewBox="0 0 13.283 9.66">
                  <path id="payments_FILL0_wght400_GRAD0_opsz24" d="M47.849-794.566a1.747,1.747,0,0,1-1.283-.528,1.747,1.747,0,0,1-.528-1.283,1.747,1.747,0,0,1,.528-1.283,1.747,1.747,0,0,1,1.283-.528,1.747,1.747,0,0,1,1.283.528,1.747,1.747,0,0,1,.528,1.283,1.747,1.747,0,0,1-.528,1.283A1.747,1.747,0,0,1,47.849-794.566Zm-4.226,1.811a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853v-4.83a1.163,1.163,0,0,1,.355-.853,1.163,1.163,0,0,1,.853-.355h8.453a1.163,1.163,0,0,1,.853.355,1.163,1.163,0,0,1,.355.853v4.83a1.163,1.163,0,0,1-.355.853,1.163,1.163,0,0,1-.853.355Zm1.208-1.208h6.038a1.163,1.163,0,0,1,.355-.853,1.163,1.163,0,0,1,.853-.355v-2.415a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853H44.83a1.163,1.163,0,0,1-.355.853,1.163,1.163,0,0,1-.853.355v2.415a1.163,1.163,0,0,1,.853.355A1.163,1.163,0,0,1,44.83-793.962Zm6.641,3.623H41.208a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853v-6.641h1.208v6.641H51.471Zm-7.849-3.623v0Z" transform="translate(-40 800)" fill="#fff"/>
                </svg>              
                  دریافت
              </button>
            @else
            <i class="fa fa-arrow-left-long text-danger"></i>
            <span class="">قیمت چالش:</span>
            
            @if($discount)
            <div class="d-grid" style="line-height:9px">
              <b class=" text-danger">{{number_format($price)}}</b>
              <small class="text-decoration-line-through">{{number_format(50000)}}</small>
            </div>
            
            @else
              <b class="">{{number_format($price)}}</b>
            @endif
              
              <span class="">تومان</span>
              <button  onclick="buyChall()" class="align-items-center btn btn-success col-3 d-flex fw-bold gap-2 justify-content-center py-1 rounded" style="font-size: 10pt;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13.283" height="9.66" viewBox="0 0 13.283 9.66">
                  <path id="payments_FILL0_wght400_GRAD0_opsz24" d="M47.849-794.566a1.747,1.747,0,0,1-1.283-.528,1.747,1.747,0,0,1-.528-1.283,1.747,1.747,0,0,1,.528-1.283,1.747,1.747,0,0,1,1.283-.528,1.747,1.747,0,0,1,1.283.528,1.747,1.747,0,0,1,.528,1.283,1.747,1.747,0,0,1-.528,1.283A1.747,1.747,0,0,1,47.849-794.566Zm-4.226,1.811a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853v-4.83a1.163,1.163,0,0,1,.355-.853,1.163,1.163,0,0,1,.853-.355h8.453a1.163,1.163,0,0,1,.853.355,1.163,1.163,0,0,1,.355.853v4.83a1.163,1.163,0,0,1-.355.853,1.163,1.163,0,0,1-.853.355Zm1.208-1.208h6.038a1.163,1.163,0,0,1,.355-.853,1.163,1.163,0,0,1,.853-.355v-2.415a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853H44.83a1.163,1.163,0,0,1-.355.853,1.163,1.163,0,0,1-.853.355v2.415a1.163,1.163,0,0,1,.853.355A1.163,1.163,0,0,1,44.83-793.962Zm6.641,3.623H41.208a1.163,1.163,0,0,1-.853-.355,1.163,1.163,0,0,1-.355-.853v-6.641h1.208v6.641H51.471Zm-7.849-3.623v0Z" transform="translate(-40 800)" fill="#fff"/>
                </svg>              
                  خرید
              </button>
            @endif
          </div>
          <div id="pay" class=" @if(!$chall->Pay) d-none @endif  align-items-center card-body d-flex gap-3 justify-content-center" style="">

              <i class="fa fa-arrow-left-long text-success-subtle"></i>
              <span class="">قیمت چالش:</span>
                <b class=""></b>
                <span class=""></span>
                <span class="align-items-center col-4 d-flex fw-bold gap-2 justify-content-center py-1 rounded" style="font-size: 10pt;">
                    <i class="fa fa-money-bills"></i>
                    @if(!$chall->Pay)
                    {{number_format($price)}}تومان 
                    @else
                    {{number_format($chall->Pay)}}تومان 
                    @endif
                </span>
          </div>
        </div>
      </div>
    {{-- <div class="leftnav">
        @if($chall->Link)
        <i class="fa fa-link c-pointer" @if($chall->Link) onclick="window.open('{{$chall->Link}}');window.focus();" @else disabled @endif></i>
        @endif
        <i class="fa fa-download c-pointer" @if($chall->File) onclick="window.open('{{$chall->File}}');window.focus();" @else disabled @endif></i>   
        <i class="fa fa-comments c-pointer" onclick="location.href='{{route('chat.index',[$chall->Id])}}'" ></i>
        <i class="fa fa-home c-pointer" onclick="location.href='{{route('home')}}'"></i>
    </div> --}}
    @endsection
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
  
 <script>
    var progressUpdate=1;
        @if($answers || $chall->Auto)
        document.getElementById('chat').classList.add('d-none');
        @endif
      function playAudio(obj)
      {
        audioPlayer=obj.parentElement.querySelector('audio');
        progressBar= obj.parentElement.querySelector('.progress');
        playericon= obj.parentElement.querySelector('.playericon');
        if(audioPlayer.error)
        {
          playericon.classList.remove('fa-play','fa-pause');
          playericon.classList.add('fa-warning');
          Swal.fire({
                      icon: 'error',
                      title: 'خطا',                        
                      confirmButtonText: 'بله',
                      text:"{{session('User')->FullName}} \n  متاسفم فایلش پیدا نشد  \n شاید حذف شده "

                  });
          return 0;
          
        }
        if (audioPlayer.paused) 
        {
            progressBar.max=audioPlayer.duration;
            audioPlayer.play();
            playericon.classList.remove('fa-play');
            playericon.classList.add('fa-pause');
            
        } 
        else {
            audioPlayer.pause();
            playericon.classList.remove('fa-pause');
            playericon.classList.add('fa-play');
          }
      }
      function changeCurrentTime(value,obj)
      {
        audioPlayer=obj.parentElement.parentElement.parentElement.querySelector('audio');
      progressBar= obj.parentElement.parentElement.querySelector('.progress');
      
        audioPlayer.pause();
        progressUpdate=0;
        audioPlayer.currentTime=value
        audioPlayer.play();
      }
      document.querySelectorAll('audio').forEach(itm=>{
        itm.addEventListener("timeupdate", function() {
          const duration = itm.duration;
          const currentTime = itm.currentTime;
          const progress = (currentTime / duration) * 100;
          itm.parentElement.querySelector('.played').style.width = progress + "%";
          if(progressUpdate)
          itm.parentElement.querySelector('.progress').value = itm.currentTime ;
          else
          progressUpdate=1;
        });
      itm.addEventListener("play", function() {
        itm.parentElement.querySelector('.playericon').classList.add('fa-pause');
        itm.parentElement.querySelector('.playericon').classList.remove('fa-play');
        });
      itm.addEventListener("pause", function() {
        itm.parentElement.querySelector('.playericon').classList.remove('fa-pause');
        itm.parentElement.querySelector('.playericon').classList.add('fa-play');
        });
      itm.addEventListener("end", function() {
      itm.parentElement.querySelector('.playericon').classList.remove('fa-pause');
      itm.parentElement.querySelector('.playericon').classList.add('fa-play');
      itm.parentElement.querySelector('.progress').value = 0 ;
      });
    });

  
</script>
        <script>
          var payed={{$chall->Pay??0}};
          @if(!$chall->Pay)
          function buyChall(auto=0)
          {
            Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
            axios.post('{{route("chall.buy")}}', {chall:'{{$chall->Id}}',expired:'{{$chall->Expired}}',expiredAt:'{{$chall->ExpiredAt}}',Price:'{{$price}}',day:'{{$chall->Expire}}',auto:auto})
                  .then(response => { 
                    if(response.data.success)
                    {
                      Swal.fire({
                                  icon: 'success',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
                              });
                        document.getElementById('unpay').classList.add('d-none');
                        document.getElementById('pay').classList.remove('d-none');
                        
                        @if(!$answers && !$chall->Auto)
                        document.getElementById('chat').classList.remove('d-none');
                        @endif

                        document.getElementById('payCard').classList.add('bg-success','text-white');
                        user_wallet.innerHTML=response.data.wallet;
                        @if($answers)
                          @php
                            $out='';
                            foreach ($answers as $index=>$opt)
                            {
                              if($index!='ans')
                              $out.='<label for="" class="col-12 gap-1"><input type="radio" class="mx-1" name="Answer" id="answer"  value="'.$opt.'">'.$num[$index].') '.$opt.'</label>';
                            }
                            echo "optionsBox.innerHTML='$out';";
                          @endphp
                        @endif
                        payed=1;
                    }
                        
                    else
                        Swal.fire({
                                  icon: 'error',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
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
          @endif
          function setAnswer(btn)
          {
            btn.disabled=true;
            const Expired={{$chall->Expired}};
            const closed={{$chall->Closed??0}};
            var useranswer=document.querySelector('input[type=radio]:checked');              

            if(closed)
            {
              btn.disabled=false;
              Swal.fire({
                  icon: 'error',
                  title: 'توجه',                
                  confirmButtonText: 'بله',
                  text:"{{session('User')->FullName}} \n زمان ارسال پاسخ این چالش گذشته "
              });
            }
            else if(!payed)
            {
              btn.disabled=false;
              Swal.fire({
                  icon: 'error',
                  title: 'توجه',                
                  confirmButtonText: 'بله',
                  text:"{{session('User')->FullName}} \n اول باید چالش رو بخری"
              });
            }
            else
            {
              if(useranswer)
              {
                Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
                axios.post('{{route("chall.answer")}}', {chall:'{{$chall->Id}}',answer:useranswer.value})
                  .then(response => { 
                    if(response.data.success)
                    {
                      
                        Swal.fire({
                                  icon: (response.data.success==1)?'success':'error',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
                              });
                              btn.classList.add('d-none');                               

                              var ans=useranswer.value;
                              optionsBox.innerHTML='';
                              var opt={!! json_encode($answers) !!};
                              var num={'first':'الف','second':'ب','third':'ج','forth':'د','fifth':'ه','sixth':'و'};
                              Object.keys(opt).forEach(itm=>{
                                    if(itm!='ans')
                                    {
                                      const label = document.createElement("label");
                                      label.classList.add("col-12", "gap-1");
                                      const icon = document.createElement("i");
                                      if(opt[itm]==opt.ans || (ans==opt[itm] && opt[itm]==opt.ans))
                                      icon.classList.add("fa", "fa-circle-check", "fa-regular", "my-auto");
                                      else if(ans==opt[itm])
                                      icon.classList.add("fa", "fa-circle-xmark", "fa-regular", "my-auto");
                                      else
                                      icon.classList.add("fa", "fa-circle", "fa-regular", "my-auto");
                                      label.appendChild(icon);
                                      const span = document.createElement("span");
                                      span.innerHTML = num[itm]+') '+opt[itm];
                                      span.classList.add('mx-1') ;
                                      label.appendChild(span);
                                      optionsBox.appendChild(label);
                                    }
                                
                                   } );
                             
                              
                              //optionsBox.querySelectorAll('input').forEach(itm=>{itm.disabled=true;})

                              if(response.data.wallet)
                              user_wallet.innerHTML=response.data.wallet;
                    }
                    else
                        Swal.fire({
                                  icon: 'error',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
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
              else
              {
                Swal.fire({
                icon: 'error',
                title: 'توجه',                
                confirmButtonText: 'بله',
                text:"{{session('User')->FullName}} \n یه گزینه انتخاب کن "
                 });
              }
              btn.disabled=false;
            }
              
          }
        </script>
        <script>
          $(document).ready(function()
          {
            if(document.querySelector('.videoRes'))
            {
                $('.playicon').click(function ()
                  {
                    var videoRes=this.parentElement.querySelector('.videoRes');
                    if($('.carousel-caption').length)
                    this.parentElement.parentElement.parentElement.querySelector('.carousel-caption').classList.add('text-3b407a');
                    if(!videoRes.src)
                    {      
                      videoRes.src = videoRes.children[0].getAttribute('data-src');
                      videoRes.load();
                    }
                    if(videoRes.paused)
                    {
                      videoRes.play();
                      videoRes.classList.remove('blurEffect');
                      $('.playicon').hide();
                      if($('.carousel-caption').length)
                      $('.carousel-caption').hide();
                    }
                  });
                
                document.querySelectorAll('.videoRes').forEach((itm)=>{
                  itm.addEventListener("pause", function(){
                       $('.playicon').show();
                       if($('.carousel-caption').length)
                       $('.carousel-caption').show();
                      itm.classList.add('blurEffect');
                      itm.removeAttribute("controls");
                    });
                  itm.addEventListener("ended", function(){
                    itm.addClass('blurEffect');
                        itm.removeAttribute("controls");
                      $('.playicon').show();
                      if($('.carousel-caption').length)
                      $('.carousel-caption').show();
                    });
                    itm.addEventListener("play", function(){
                      itm.setAttribute("controls", "controls");
                      itm.classList.remove('blurEffect');
                      $('.playicon').hide();
                      if($('.carousel-caption').length)
                      $('.carousel-caption').hide();

                    });
                });
            
            }
    });
        function playpause()
        {
          if($('.carousel-caption').length)
          $('.carousel-caption').show();
          progressUpdate=0;
         document.querySelectorAll('.videoRes').forEach((itm)=>{
            itm.pause();
          });
         document.querySelectorAll('audio').forEach((itm)=>{
            itm.pause();
          });
        }
    </script>
    @endsection