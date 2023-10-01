@extends('layouts.app')
<style>
     @media (max-width: 760px)
    {
        #content {
            color: #fff;
            background-image: url("{{asset('img/details/back.png')}}");
            /* background-attachment: fixed; */
            background-attachment: scroll;
            background-size: cover;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 94vh; */
            padding: 4vw;
        }
        .earth {
           position: fixed;
            top: -55px;
            right: -32px;
            /* rotate: 333deg; */
        }
        .earth img
        {
            /* width: 90vw; */
            width: 290px;
            rotate: 333deg;
        }
        .titlebox {
           width: 100%;
            /* left: 69px; */
            position: fixed;
            color: #aeb1d4;
            top: 30%;
            font-size: 35pt!important;
            display: grid;

        }
        .titlebox b{
            font-weight: 900;
            font-family:'PEYDA-BLACK';
            font-size: 44pt!important;

        }
        .titlebox h2{
            font-size: 35pt!important;
            text-shadow: 2px 3px 3px #323030ad;

        }
        .bodybox {
            position: fixed;
            background: linear-gradient(230deg, #20234c, #373c74);
            border-radius: 15px;
            padding:5px 15px;
            width: 95%;
            left:40%;
            transform: translate(-40%, 0);
            bottom: 33vh;
            box-shadow: 0 0 5px -1px #2f346c;
            font-size: 8pt;
            height: 12vh;
            overflow: auto;
            font-family:Peyda;
            line-height:22px;
            text-align: justify;
        }
        
        .bodyvideo {
           position: fixed;
            /* background: linear-gradient(230deg, #292d649c, #373c7480); */
            border-radius: 25px;
            padding: 11px;
            /* width: 91vw; */
           
            left:45px;
            height: 22vh;
            bottom: 10vh;
            /* box-shadow: 0 0 5px -1px #2f346c; */
            text-align: center;
        
        }
        .bodyimg {
           width: 91vw;
        
        }
        .leftnav
         {
            border-radius: 14px;
            display: grid;
            gap: 20px;
            color: #ccd0f4;
            background-color: #53588f;
            position: fixed;
            left: -8px;
            bottom: 9vh;
            width: fit-content;
            padding: 14px;
            opacity: 0.9;
        }
        
        .bodyItm {
            border-radius: 25px;
            /* padding: 11px; */
            width: 84%;
             height: 100%;
            box-shadow: 0 0 14px -1px #50558c;
            opacity: 0.8;
        }
    }
     @media (min-width: 760px)
    {
        #content {
            color: #fff;
            background-image: url("{{asset('img/details/back.png')}}");
            /* background-attachment: fixed; */
            background-attachment: scroll;
            background-size: cover;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 94vh; */
            padding: 4vw;
        }
        .earth {
            position: relative;
            top: -138px;
            right: -60px;
            /* rotate: 333deg; */
        }
        .earth img
        {
            width: 290px;
            rotate: 333deg;
        }
        .titlebox {
            width: 228px;
            left: 38%;
            position: fixed;
            color: #aeb1d4;
            top: 42%;
            font-size: 25pt!important;
            display: grid;

        }
        .bodybox {
            position: relative;
            background: linear-gradient(230deg, #292d64, #373c74);
            border-radius: 15px;
            padding: 11px;
            width: 95%;
            bottom: 20px;
            box-shadow: 0 0 5px -1px #2f346c;
            font-size: 8pt;
            height: 12vh;
            overflow: auto;

        }
        .bodyvideo {
            position: relative;
            /* background: linear-gradient(230deg, #292d649c, #373c7480); */
            border-radius: 25px;
            padding: 11px;
            width: 98%;
            height: 21vh;
            bottom: 14px;
            /* box-shadow: 0 0 5px -1px #2f346c; */
            text-align: center;
        
        }
        .bodyItm {
            border-radius: 25px;
            /* padding: 11px; */
            width: 84%;
             height: 100%;
            box-shadow:0 0 14px -1px #50558c;
            opacity: 0.8;
        }
        .leftnav
        {
            border-radius: 14px;
            display: grid;
            gap: 20px;
            color: #ccd0f4;
            background-color: #53588f;
            position: relative;
            left: -102%;
            bottom: 10vh;
            width: fit-content;
            padding: 14px;
            opacity: 0.9;
        }
    }
     body
        {
            /* background-image: url("{{asset('img/details/full_back.png')}}");
            background-attachment: fixed;
            background-size: 117vw;
            background-repeat: no-repeat;
            background-position: 0px -102px; */

        }
        #FullHeight, #content {
             height: 100vh!important; 
        }
        
        .icon
        {
            width: 50px;
        }
.overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
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
</style>
@section('content')   
<div class="earth">
    @if(in_array($chall->Chall->Type??'text',['image','archive','audio']))
    <img src="{{asset('img/details/other.png')}}" alt="">
    @else
    <img src="{{asset('img/details/'.($chall->Chall->Type??'text').'.png')}}" alt="">
    @endif
</div>
<div class="titlebox" id="title">
    <b class="opacity-50">چالش </b>
    <h2 class="">
        {{$chall->Chall->Title}}
    </h2>
</div>
@if($chall->Chall->Body)
<div class="bodybox">
    <p>
        {!!$chall->Chall->Body!!}
    </p>
</div>
@endif
<div>
@if($chall->Chall->Type=='movie')
    <video  class="bodyvideo" controlsList="nodownload" controls src="{{$chall->Chall->File}}"></video>
@elseif($chall->Chall->Type=='audio')
   <audio class="bodyvideo" controlsList="nodownload" controls  src="{{$chall->Chall->File}}" ></audio>
@elseif($chall->Chall->Type=='image')
<div class="bodyvideo bodyimg d-inline-block">
    <img src="{{$chall->Chall->File}}" alt="Image" class="bodyItm">
    <div class="overlay">
      <a href="{{$chall->Chall->File}}" target="_blank" download>
       <img src="{{asset('img/details/download.png')}}" alt="Image" class="icon">
      </a>
    </div>
</div>
@elseif($chall->Chall->Type=='archive')
<div class="bodyvideo bodyimg d-inline-block">
    <img src="{{asset('img/login/pic.png')}}" alt="Image" class="bodyItm">
    <div class="overlay">
      <a href="{{$chall->Chall->File}}"  target="_blank" download>
       <img src="{{asset('img/details/download.png')}}" alt="Image" class="icon">
      </a>
    </div>
</div>
@endif



</div>
<div class="leftnav">
    @if($chall->Chall->Link)
    <i class="fa fa-link c-pointer" @if($chall->Chall->Link) onclick="window.open('{{$chall->Chall->Link}}');window.focus();" @else disabled @endif></i>
    @endif
    <i class="fa fa-download c-pointer" @if($chall->Chall->File) onclick="window.open('{{$chall->Chall->File}}');window.focus();" @else disabled @endif></i>   
    <i class="fa fa-comments c-pointer" onclick="location.href='{{route('chat.index',[$chall->Id])}}'" ></i>
    <i class="fa fa-home c-pointer" onclick="location.href='{{route('home')}}'"></i>
</div>
@endsection