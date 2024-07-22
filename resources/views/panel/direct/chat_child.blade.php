@extends('layouts.childApp')
@section('style')
    <style>
      .Parent
      {
        word-break: break-word;
        text-align: left;
        font-size: 7pt;
        border-radius: 11px 4px 4px 4px;
        background-color: #ffffff1c;
        padding: 5px 0px 0 0px;
        border-left: 2px solid #ffffff47;
      }
      .Parent>div
      {
        padding-top: 2px;padding-left: 12px; gap: 4px;
      }
      .replydiv
      {
        bottom: -10px;
        font-size: 8pt;
        height: 29px;
        position: absolute;
        width: 92%;
        margin-right: 13px;
        margin-block: 0px;
        z-index: 0;
        background: #f3f3f3;
        opacity: 0.5;
        border-radius: 16px 16px 0 0px;
        overflow: hidden;

      }
      .tools i
      {
        width: 23px;
        height: 23px;
        border-radius: 50%;
        background-color: #98999f8c;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 10px;
        cursor: pointer;
      }
      .tools i:hover
      {
        background-color: #98999f;
      }
      .toolsDiv
      {
        background-color: #98999f;
        color: #fff;
        font-size: 7pt;
        padding: 4px;
        border-radius: 4px;
        height: auto;
        margin: auto;
        justify-content: space-around;
        display: flex;
        width: 60px;
      }
      @media (min-width: 760px)
        {
            #content
            {
                width: 100%!important;
            }
            
        }
        #content
         {
            color: #4b4b4b;
            background-color: #F7F7F7;
            /* height: 100vh; */
            overflow: hidden;
            /* height: 88vh; */
            /* padding: 4vw; */
        }
        #chats {
            background: #F7F7F7;
            /* padding: 15px;
            border-radius: 35px;
            box-shadow: inset 0px 4px 11px -4px #b5b5b5; */
            height: 75vh;
            overflow: hidden;
        }
        #chatBox {
            height: 64vh;
            overflow-y: auto;
        }
        .datechat
        {
          font-size: 9pt;
          text-align: center;
         color: #41403e;
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
     #msgtxt:focus
        {
            outline:none!important;
            border-color: transparent!important;
            background-color: #f3f3f3!important;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9!important;
        }
        #msgtxt::placeholder
        {
            color: #95a9b4;
            padding-top: 5px;
            background-color: #f3f3f3;

        }
        .line {
            border-top: 1px solid black;
            margin-top: 12px;
            margin-bottom: 20px;
        }
        .card-body {
            display: grid;
            grid-auto-rows: max-content;
            padding: 3%;
            grid-auto-columns: max-content;
            justify-content: center;
            height: 50rem;
            border:1px solid gray;
            overflow: auto;
            background-color: white;
        }

        .img-circle {
            width: 50%;
            max-width: 10%;
            height: 100%;
        }

        .sender
        {
          background-color: #fff;
          /* border:2px solid #7C80AB; */
          color: #2d2d2d;
           float:right;
           border-radius:16px 0 16px 16px;
           margin: 5px;
           padding: 6px;
           font-size: 8pt;
        }
        .STriangle {
        /* width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #ababab;
        rotate: 314deg;
        margin-left: -12px;
        margin-top: 3px; */
        margin-left: -5px;
        margin-top: 5px;
        } 
    
        .preSender
        {
          
           border-radius:15px 0 15px 15px!important;
        }
        .number
        {
           font-size: 6pt;          
        }
        .sendbox
        {
          margin-top: 0px;
          /* border-top: 1px solid; */
          padding: 10px;
          /* display: inline-flex; */
          justify-content: center;
        }
        .sendbox textarea
        {
            background-color: #f3f3f3;
            font-size: 9pt;
            border: none;
            border-radius: 0;
            resize: none;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
        .sendbox .chatbox-rightbtn
        {
          border-radius:  0px 25px 25px 0;
          background-color: #f3f3f3;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
        .sendbox .chatbox-leftbtn
        {
          border-radius: 25px 0px 0 25px;
          background-color: #f3f3f3;
            box-shadow: inset 0px 5px 10px -3px #d9d9d9;
        }
        .sendbox button
        {
          color:#393939;
          border:none;
        }
        .resiver p,.sender p
        {
          font-family: "Peyda";
        }
        .senderImg
        {
          filter:grayscale(0%) sepia(10%) hue-rotate(178deg)
        }
        .resiver
        {
            background-color: #FEF3D2;
            color: #454442;
            float: left;
            border-radius: 0 16px 16px 16px;
            margin: 5px;
            padding: 6px;
            font-size: 8pt;
        }
        .RTriangle {
        /* width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid #FEF3D2;
        rotate: 45deg;
        margin-right: -12px;
        margin-top: 4px; */
        margin-right: -5px;
        margin-top: 5px;
        }
        .preResiver
        {
           
            border-radius: 0 15px 15px 15px!important;
        }
        .chatcard
        {
          align-items: center;
          display: inline-flex;
          flex-direction: row-reverse;
        }
        .emoji {
          display: inline-block;
          font-size: 15pt;
          margin: 5px;
          cursor: pointer;
        }

        #emojiBox {
            width: 85%;
            height: 230px;
            border: 1px solid #d0d1df91;
            overflow-y: scroll;
            background-color: #d0d1df91;
            border-radius: 6px;
            position: relative;
            bottom:292px;
            right: 7%;
            padding: 8px;
            padding-right: 10px;
     }

     .equalizer {
      display: flex;
      justify-content: center;
      align-items: center;
      /*align-items: flex-end;
      height: 40px;
      width: 100%;
      background-color: #f2f2f2;
      padding: 20px;*/
    }
    
    .bar {
      width: 4px;
      margin: 0 5px;
      background-color: #b59f64;
    }
    .waveplayer {
    width: 100%;
    height: 50px;
    /* border: 9px solid white; */
    border-radius: 15px;
    padding: 5px;
    box-shadow: 0px 3px 5px 0px #c5c5c5;
}
.wave {
    width: 95%;
    /* height: 59px; */
    background-image: url('{{asset("img/player/wave.jpg")}}');
    background-size: 28px;
    background-position: center;
    background-repeat-y: no-repeat;
    background-blend-mode: screen;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    background-color: #fefefe94;
    position: relative;
}
.played {
    width: 0%;
    float: left;
    height: -webkit-fill-available;
    background-image: url('{{asset("img/player/wave.jpg")}}');
    background-size: 28px;
    background-position: left;
    background-repeat-y: no-repeat;
    /* border: 9px solid white; */
    /* border-radius: 15px; */
    /* background-color: red; */
}
.progress
      {
      position: absolute;
        width: 101%;
        /* margin-bottom: -40px; */
        padding: 12px;
        direction: ltr;
        opacity: 0; 
        cursor: pointer;
        top:4px;
    }
   
    .picfile {
    /* background-size: cover; */
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
    height: 154px;
    background-color: #00000059;
    background-blend-mode: darken; 
    /* background-color: #4e4e4e91;
    background-blend-mode: darken; */
    width: 100%;
    border-radius: 23px;
    display: flex;
    justify-content: center;
    align-items: center;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
}
    .videofile {
    background-repeat: no-repeat;
    background-color: #e3e3e4;
    background-image: url("{{asset('img/Logored.png')}}");
    background-size: 60%;
    background-position: center;
    background-blend-mode: darken;
    width: 100%;
    height: 154px;
    border-radius: 23px;
    display: flex;
    justify-content: center;
    align-items: center;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
}
.videoplayer {

    margin-top: 4%;
    width: 100%;
    height: 154px;
    border-radius: 23px;
    /* box-shadow: 0px 6px 10px -5px #1a18188f; */
    object-fit: scale-down;
    background-color: #fff;;
}
    </style>
@endsection
@section('subtitle')  
<h6 class="mb-2 text-center" >ارتباط مستقیم با استاد عرفان خوش نظر</h6> 
@endsection

@section('content')
  <div class="col-md-12 mt-2" id="chats">
    @php
        $pre=0;
    @endphp
    <div id="chatBox">
     @foreach($chats->groupBy(function($chats) {
        return date('Y-m-d',strtotime($chats['Date']));
        }) as $date => $messages)
        @if(jdate($date)->format('Y-m-d')!=jdate()->format('Y-m-d'))
        <h6 class="datechat" >{{jdate($date)->format('d F')}}</h6>
        @else
        <h6 class="datechat" >امروز</h6>
        @endif
      @php
        if(jdate($date)->format('Y-m-d')!=jdate()->format('Y-m-d'))
          $dates[]=jdate($date)->format('d F');
          else
          $dates[]='امروز';
      @endphp
        @foreach($messages as $msg)        
        @php
            $msg=(object)$msg;
        @endphp
          <div id="msg_{{$msg->Id}}" class="col-md-12 d-flex @if($pre!=$msg->SenderId) mt-2 @endif  @if(session('User')->Id!=$msg->SenderId) flex-row-reverse @endif " >
              {{-- <div class="" style="text-align: left;"> --}}
                <img src="{{ asset('img/user.png') }}" class="img-circle @if(session('User')->Id==$msg->SenderId) senderImg @endif @if($pre==$msg->SenderId) opacity-0 @endif " alt="User Image">                          
              {{-- </div> --}}
              @if($pre!=$msg->SenderId)
                @if(session('User')->Id==$msg->SenderId)
                <svg width="10" height="10" class="STriangle">
                  <polygon points="0,0 0,10 10,0"   fill="#fff" />
                </svg>
                @else
                <svg width="10" height="10" class="RTriangle">
                  <polygon points="0,0 10,0 10,10" fill="#FEF3D2"  />
                </svg>
                @endif
              @else
              <svg width="10" height="10" class="@if(session('User')->Id==$msg->SenderId) STriangle @else RTriangle @endif"></svg>
              @endif
              
              <div class=" @if(session('User')->Id==$msg->SenderId) @if($pre==$msg->SenderId) preSender @endif sender @else @if($pre==$msg->SenderId) preResiver @endif resiver @endif  col-md-6 col-8 row  ">            
                <div class="col-md-12 text-right" style="word-break: break-word;">
                  @if($pre!=$msg->SenderId) 
                  <b>{{$msg->SenderName}}</b>
                  @endif
                  @if($msg->Parent)
                  <div class="col-md-12 text-right Parent">
                    <div>
                      @php
                      $body=$txt=$mFile='';
                      $rep=(object)$chats->where('Id',$msg->Parent)->first();
                      if($chats->where('Id',$msg->Parent)->count())
                      {
                        $txt=str_replace("\n"," ",$rep->Message);
                        $body=Str::limit($txt, 20, ' ');
                        $mfile=$rep->File;
                        if(strlen($txt)>20)
                        $body.='...';
                        $body=($body)?$body:((Str::contains($mfile, '_voice__'))?"پیام صوتی":'رسانه');
                      }
                      
                      @endphp
                      <b class="">{{$rep->SenderName??''}}</b>
                      <p>{{$body}}</p>
                    </div>
                  </div>
                  @endif
                  @if($msg->Message)
                      <p>{!!strtr($msg->Message,["\n"=>"<br>"])!!}</p>
                      @if($msg->File)
                      <button onclick="window.open('{{$msg->File}}','_blank')" class="pull-left fa fa-download btn "> </button>
                      @endif
                  @elseif(Str::contains($msg->File, '_voice__'))
                  <div class="d-flex gap-2 m-0 py-1">
                    <audio src="{{$msg->File}}" id="player{{$msg->Id}}" class="d-none"></audio>
                    <div class="bg-light d-flex justify-content-center waveplayer">
                    <div class="wave" id="wave{{$msg->Id}}">
                      <div class="played" id="played{{$msg->Id}}"></div>
                        <input type="range"  value="0" step="0.1" onchange="changeCurrentTime(this.value,'{{$msg->Id}}')" id="progress{{$msg->Id}}" class="progress">                          
                      </div>
                    </div>
                    <div class="circle btn btn-dark bg-dark m-auto" onclick="playAudio('{{$msg->Id}}')">
                      <i class="fa fa-play " id="playericon{{$msg->Id}}"></i>
                    </div>
                  </div>
                  @elseif(Str::contains($msg->File, '_image__'))
                  <div class="picfile" style="background-image: url({{$msg->File}})">
                    <a href="{{$msg->File}}" target="_blank" download>
                      <img src="{{asset('img/details/download.png')}}" alt="Image" width="70" height="70">
                      </a>
                  </div>
                  @elseif(Str::contains($msg->File, '_movie__'))
                  <div class="videofile" id="videoDiv{{$msg->Id}}" style="background-color: #fff">
                      <img onclick="videoPlay('{{$msg->Id}}')" style="cursor: pointer" src="{{asset('img/details/play.png')}}" alt="Image" width="70" height="70">
                    
                  </div>
                  <video controls poster="{{asset('img/Logored.png')}}" class="videoplayer d-none" id="Vplayer{{$msg->Id}}" >
                    <source id="VSource{{$msg->Id}}" data-src="{{$msg->File}}" type="video/{{explode('.',$msg->File)[1]}}">
                  </video>
                  @else
                  <div class="d-flex gap-1" style="cursor: pointer;word-break: break-word;padding: 10px;" onclick="window.open('{{$msg->File}}','_blank')">
                    <i class=" fa fa-2x fa-file fa-regular"></i>
                    <b dir="ltr" style="font-size: 5pt;">{{last(explode('/Direct/user_'.$user->Id.'/',$msg->File))}}</b>                
                  </div>
                  @endif
                </div>
                <div class="@if($user->Id==$msg->SenderId) p-0 text-right  @else text-left @endif ">
                  @if($user->Id==$msg->SenderId)
                  <i class="fa  @if($msg->Read) fa-check-double px-1 text-3b407a @else fa-check @endif "></i>
                  @endif
                  <label class="fw-bolder number">{{jdate($msg->Date)->format('H:i:s')}}</label>
                </div>
              
              </div> 
              <div class="tools d-flex flex-wrap-reverse gap-2 h-100 my-auto p-1  d-none " id="divtools_{{$msg->Id}}" >
                
                  @if(session('User')->Id==$msg->SenderId)
                    @if(date_create($msg->Date)->modify('+24 hours')>=date_create(date('Y-m-d H:i:s')))                  
                      <div class="d-flex gap-1 @if(session('User')->Id==$msg->ReceiverId) flex-row-reverse @endif " onclick="removemsg({{$msg->Id}});" >
                        <i class="fa fa-trash"></i>
                        <div id="divtrash{{$msg->Id}}" class="toolsDiv d-none">حذف</div>
                      </div>
                      @if($msg->Message)
                      <div class="d-flex gap-1 @if(session('User')->Id==$msg->ReceiverId) flex-row-reverse @endif " onclick="editmsg({{$msg->Id}});">
                        <i class="fa fa-pencil"></i>
                        <div id="divpencil{{$msg->Id}}" class="toolsDiv d-none">ویرایش</div>
                      </div>
                      @endif
                    @endif
                  @endif
                  @if($msg->Message)                  
                    <div class="d-flex gap-1 @if(session('User')->Id==$msg->ReceiverId) flex-row-reverse @endif " onclick="copymsg({{$msg->Id}});" >
                      <i class="fa fa-copy"></i>
                      <div id="divcopy{{$msg->Id}}" class="toolsDiv d-none">کپی</div>
                    </div>
                  @endif
                  <div class="d-flex gap-1 @if(session('User')->Id==$msg->ReceiverId) flex-row-reverse @endif " onclick="replymsg({{$msg->Id}});">
                    <i class="fa fa-reply"></i>
                    <div id="divreply{{$msg->Id}}" class="toolsDiv d-none">پاسخ</div>
                  </div>                  
              
              </div>
          </div> 
          
          @php
            $pre=$msg->SenderId;
          @endphp
        @endforeach
          @if(!$loop->last)
            @php
              $pre=0;
            @endphp
          @endif
     @endforeach
    </div>
   
     
<div class="position-relative text-center d-none" id="ReplyConter">
  <div class="d-flex p-2 replydiv">
    <i class="col-2 fa fa-close c-pointer" onclick="rmReply()"></i>
    <p class="col" id="replyTxt"></p>        
  </div>
</div>

<div class="col-md-9 d-flex  mx-auto sendbox">
  <div class="d-flex chatbox-rightbtn" >
  <button class="btn fa fa-paperclip" onclick="emojiBox.classList.add('d-none');fileatt.click()"></button>
  <button class="btn fa fa-regular fa-smile-beam" onclick="emojiBox.classList.toggle('d-none');"></button>
  <button class="btn fa fa-microphone" onclick="emojiBox.classList.add('d-none');delvoice();recordVoice.show()"></button>
  </div>
  <textarea name="" id="msgtxt" rows="2" class="col-md-9 form-control"  placeholder="متن پیام"></textarea>
  <div class="d-flex flex-row-reverse chatbox-leftbtn" >
    <button class="fa fa-paper-plane btn " id="btnSMSG" onclick="sendmsg(this)"></button>
    <button class="fa fa-check-circle btn d-none" id="btnEMSG" onclick="updatemsg(this)"></button>
    <input type="file" name="" id="fileatt" onchange="showprewview(this);" class="d-none" accept="">
  </div>
</div>

<div id="emojiBox" class="d-none">
  <div class="emoji">😉</div>
  <div class="emoji">😀</div>
  <div class="emoji">😊</div>
  <div class="emoji">😇</div>
  <div class="emoji">🙂</div>
  <div class="emoji">🙃</div>  
  <div class="emoji">😚</div>
  <div class="emoji">😃</div>
  <div class="emoji">😄</div>
  <div class="emoji">😁</div>
  <div class="emoji">😆</div>
  <div class="emoji">😅</div>  
  <div class="emoji">😂</div>
  <div class="emoji">🤣</div>
  <div class="emoji">😎</div>
  <div class="emoji">😌</div>
  <div class="emoji">😋</div>
  <div class="emoji">😍</div>
  <div class="emoji">🥰</div>
  <div class="emoji">😗</div>
  <div class="emoji">😙</div>
  <div class="emoji">😘</div>
  <div class="emoji">🤨</div>
  <div class="emoji">🤔</div>
  <div class="emoji">🤩</div>
  <div class="emoji">😐</div>
  <div class="emoji">😑</div>
  <div class="emoji">😶</div>
  <div class="emoji">😣</div>
  <div class="emoji">😏</div>
  <div class="emoji">🙄</div>
  <div class="emoji">😥</div>
  <div class="emoji">😮</div>
  <div class="emoji">🤐</div>
  <div class="emoji">😫</div>
  <div class="emoji">😪</div>
  <div class="emoji">😯</div>
  <div class="emoji">🥱</div>
  <div class="emoji">😴</div>
  <div class="emoji">😛</div>
  <div class="emoji">😜</div>
  <div class="emoji">😝</div>
  <div class="emoji">🤤</div>
  <div class="emoji">😒</div>
  <div class="emoji">😓</div>
  <div class="emoji">😔</div>
  <div class="emoji">😕</div>
  <div class="emoji">🙁</div>
  <div class="emoji">😖</div>
  <div class="emoji">😞</div>
  <div class="emoji">😤</div>
  <div class="emoji">😟</div>
  <div class="emoji">😢</div>
  <div class="emoji">😭</div>
  <div class="emoji">😲</div>
  <div class="emoji">😦</div>
  <div class="emoji">😨</div>
  <div class="emoji">😰</div>
  <div class="emoji">😱</div>
  <div class="emoji">😬</div>
  <div class="emoji">😳</div>
  <div class="emoji">😠</div>
  <div class="emoji">😡</div>
  <div class="emoji">🤒</div>
  <div class="emoji">🥺</div>
  <div class="emoji">🤓</div>
  <div class="emoji">😈</div>
  <div class="emoji">👿</div>
  <div class="emoji">💀</div>
  <div class="emoji">🐵</div>
  <div class="emoji">🙈</div>
  <div class="emoji">🙉</div>
  <div class="emoji">🙊</div>
  <div class="emoji">👀</div>
  <div class="emoji">👂</div>
  <div class="emoji">💪</div>  
  <div class="emoji">🌼</div>
  <div class="emoji">🌻</div>
  <div class="emoji">🌺</div>
  <div class="emoji">🌸</div>
  <div class="emoji">🌷</div>
  <div class="emoji">🌹</div>
  <div class="emoji">🍂</div>
  <div class="emoji">💋</div>
  <div class="emoji">💙</div>
  <div class="emoji">👉</div>
  <div class="emoji">👈</div>
  <div class="emoji">👇</div>
  <div class="emoji">☝</div>
  <div class="emoji">👍</div>
  <div class="emoji">👎</div>
  <div class="emoji">🖐</div>
  <div class="emoji">👋</div>
  <div class="emoji">☝</div>
  <div class="emoji">✌</div>
  <div class="emoji">👌</div>
  <div class="emoji">👏</div>
  <div class="emoji">🙏</div>
  <div class="emoji">🙌</div>
  <div class="emoji">🤲</div>
</div>
  </div> 

<dialog id="dialogFile" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">ارسال فایل</h6>
    <button class="btn btn-close " id="fileprev_del" onclick="fileatt.value='';dialogFile.close()"></button>
  </div>
  <div class="">
    <div class="bg-body-secondary d-flex p-2 p-md-4">
      <div class="m-auto d-grid">
        <span id="prevNAME" class=" small">219918-P1BLEW-593.png</span>        
         <span id="prevSIZE" class=" bold ltr number" style="font-size: 8pt">63.23 KB</span>
      </div>
    
      <div id="prevIMG" class="circle">
        <i class="fa fa-file fa-regular"></i>
      </div>
    </div>
    
  </div>
  <div class="box-footer mt-2">
    <textarea name="" id="msg2" rows="2" class=" form-control" style="font-size: 9pt;border-radius: 10px;resize: none;" placeholder="متن پیام"></textarea>
    <button class="btn btn-primary mt-2 pull-left"   onclick="sendmsg(this,1)"   >ارسال</button>
  </div>
</dialog>
<dialog id="recordVoice" style="height: unset">
  <div class="d-flex">
    <h6 class="col-11">ارسال صدا</h6>
    <button class="btn btn-close " id="recordVoice_del" onclick="stopRecording(rcdBtn);delvoice();recordVoice.close()"></button>
  </div>
  <div class=" p-3" id="record">
    <div class="bg-body-secondary d-flex p-2 p-md-4">
      <div class="m-auto d-grid">
        <div class="equalizer" id="prevVoiceNAME" >
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
      </div>
    
      <div class="circle btn btn-dark bg-dark" id="rcdBtn" onclick="startRecording(this)">
        <i class="fa fa-microphone"></i>
      </div>
    </div>
    
  </div>
  <div class="bg-body-secondary p-1 rounded-3 d-none" id="prev">
    <div class="d-flex gap-2 justify-content-center m-auto p-2">
      <div class="circle btn btn-dark bg-dark m-auto" id="VoiceDel" onclick="delvoice()">
        <i class="fa fa-trash " ></i>
      </div>
          <div class="bg-light d-flex justify-content-center waveplayer">
            <div class="wave" id="waveRecord">
              <div class="played" id="playedRecord"></div>
                <input type="range"  value="0" step="0.1" onchange="changeCurrentTime(this.value,'Record')" id="progressRecord" class="progress">  
                
            </div>
          </div>
          <div class="circle btn btn-dark bg-dark m-auto" onclick="playAudio('Record')">
            <i class="fa fa-play " id="playericonRecord"></i>
          </div>
    </div>
  </div>
  <div class="box-footer mt-2" id="voiceFooter">
    <audio src="" class="d-none" id="playerRecord"></audio>
    <button class="d-none btn btn-primary mt-2 pull-left" id="sendVoicebtn" onclick="sendVoice(this)">ارسال</button>
  </div>
</dialog>

<form action="" id="frm3">@csrf</form>
<audio src="{{asset('sound/chat.mp3') }}" id="chataudio" style="display: none"></audio>
@endsection
@section('script')
<script>
  var replyId=0;
  var msgs=[];
  getMsgs({!!$chats->toJson()!!});
  $(chatBox).ready(function()
  {
    chatBox.scrollTo( chatBox.scrollHeight, chatBox.scrollHeight); 
  });
  
  function getMsgs(allItems)
   {
    var options = { day: "2-digit", month: "long" };
    allItems.forEach(function(data){
      
       var date = new Date(data.Date);
       data.Time = new Date(data.Date).toLocaleDateString("fa-IR", { hour: '2-digit', minute: '2-digit',second:'2-digit' }).split(',')[1];
       data.Date2 = date.toLocaleDateString("fa-IR", options);
       if(data.Date2==new Date().toLocaleDateString("fa-IR", options))
       data.Date2="امروز";
       msgs.push(data);
    });
   }
  chatBox.addEventListener('click', () => {emojiBox.classList.add('d-none'); });
  const emojiButtons = document.querySelectorAll('.emoji');
  emojiButtons.forEach(button => {
    button.addEventListener('click', () => {
      const messageInput = document.querySelector('#msgtxt');
      const emoji = button.textContent;
      messageInput.value += emoji;
      });
    });
    function replymsg(msgid)
    {
      replyId=msgid;
      ReplyConter.classList.remove('d-none');
      var msg=msgs.filter(function(item){if(item.Id==replyId) return item;});
      if(msg[0].Message)
      {
        var body=msg[0].Message.replace("\n"," ").substring(0,20);
         if(msg[0].Message.replace("\n"," ").length>20)
          body+='...';
      }
      
      var file=msg[0].File;
     
      replyTxt.innerHTML=(body)?body:((file.includes('_voice__'))?"پیام صوتی":'رسانه');
      msgtxt.value='';
      btnEMSG.classList.add('d-none');
      btnSMSG.classList.remove('d-none');
      document.querySelector('button.fa.fa-microphone').disabled=false;
      document.querySelector('button.fa.fa-paperclip').disabled=false;
    }
    function rmReply()
    {
      replyId=0;
      ReplyConter.classList.add('d-none');
      replyTxt.innerHTML='';
      btnEMSG.classList.add('d-none');
      btnSMSG.classList.remove('d-none');
      msgtxt.value='';
      document.querySelector('button.fa.fa-microphone').disabled=false;
      document.querySelector('button.fa.fa-paperclip').disabled=false;
    }
    function editmsg(msgid)
    {
      replyId=msgid;
      ReplyConter.classList.remove('d-none');
      var msg=msgs.filter(function(item){if(item.Id==replyId) return item;});
      if(msg[0].Message)
      {
      var body=msg[0].Message.replace("\n"," ").substring(0,20);
      if(msg[0].Message.replace("\n"," ").length>20)
      body+='...';
      }
      var file=msg[0].File;
      replyTxt.innerHTML=(body)?body:((file.includes('_voice__'))?"پیام صوتی":'رسانه');
      msgtxt.value=msg[0].Message;msgtxt.focus();
      btnEMSG.classList.remove('d-none');
      btnSMSG.classList.add('d-none');
      document.querySelector('button.fa.fa-microphone').disabled=true;
      document.querySelector('button.fa.fa-paperclip').disabled=true;
    }
    
    var recording=0;
    let chunks = []; 
    var progressUpdate=1;
    var uId='{{session('User')->Id}}';
    var dates={!!json_encode($dates??[])!!};

    const bars = document.querySelectorAll('.bar');
    var equ=0;
    var blobsAduio=null;
    function animateEqualizer() {
      bars.forEach((bar, index) => {
        const height = Math.floor(Math.random() *20) + 5;
        bar.style.height = height + 'px';
      });
    }
      function playAudio(id)
      {
        var sounds=document.getElementById('player'+id);
        var progress=document.getElementById('progress'+id);
        var playericon=document.getElementById('playericon'+id);
        if(sounds.error)
        {
          playericon.classList.remove('fa-play','fa-pause');
          playericon.classList.add('fa-warning');
          Swal.fire({
                      icon: 'error',
                      title: 'خطا',                        
                      confirmButtonText: 'بله',
                      text:"اولیای {{session('User')->FullName}} عزیز \n  متاسفانه فایل مورد نظر یافت نشد "

                  });
          return 0;
          
        }
        if (sounds.paused) 
        {
            progress.max=sounds.duration;
            sounds.play();
            playericon.classList.remove('fa-play');
            playericon.classList.add('fa-pause');
            
        } 
        else {
            sounds.pause();
            playericon.classList.remove('fa-pause');
            playericon.classList.add('fa-play');
          }
      }
      function changeCurrentTime(value,id)
      {
        var sounds=document.getElementById('player'+id);

        sounds.pause();
        progressUpdate=0;
        sounds.currentTime=value
        sounds.play();
      }
      function startRecording(thisButton)
      { 
        if(recording)
        stopRecording(thisButton);
        else
        {
          if (navigator.mediaDevices)
          {
          recording=1;

          // Access the camera and microphone 
          navigator.mediaDevices.getUserMedia({audio: true, video: false,}) 
            .then((mediaStream) => { 
            const mediaRecorder =  new MediaRecorder(mediaStream); 
            window.mediaStream = mediaStream; 
            window.mediaRecorder = mediaRecorder; 
            mediaRecorder.start(); 
            // Whenever (here when the recorder 
            // stops recording) data is available 
            // the MediaRecorder emits a "dataavailable" 
            // event with the recorded media data. 
            mediaRecorder.ondataavailable = (e) => { 

              // Push the recorded media data to 
              // the chunks array 
              chunks.push(e.data); 
            }; 

            // When the MediaRecorder stops 
            // recording, it emits "stop" 
            // event 
            mediaRecorder.onstop = () => { 

              /* A Blob is a File like object. 
              In fact, the File interface is 
              based on Blob. File inherits the 
              Blob interface and expands it to 
              support the files on the user's 
              systemThe Blob constructor takes 
              the chunk of media data as the 
              first parameter and constructs 
              a Blob of the type given as the 
              second parameter*/
              const blob = new Blob( 
                chunks, { 
                  type:  "audio/mpeg"
                }); 
              chunks = []; 
              blobsAduio=blob;
              // Create a video or audio element 
              // that stores the recorded media 
              

              // You can not directly set the blob as 
              // the source of the video or audio element 
              // Instead, you need to create a URL for blob 
              // using URL.createObjectURL() method. 
              const recordedMediaURL = URL.createObjectURL(blob); 

              // Now you can use the created URL as the 
              // source of the video or audio element 
              document.getElementById('playerRecord').src = recordedMediaURL; 
              // Create a download button that lets the 
              // user download the recorded media 
              

              
              
              //document.getElementById('voiceFooter').append(downloadButton); 
              record.classList.add('d-none');
              prev.classList.remove('d-none');
              sendVoicebtn.classList.remove('d-none');
            }; 

            blobsAduio=null;
            sendVoicebtn.classList.add('d-none');
            thisButton.classList.remove('btn-dark','bg-dark');
            thisButton.classList.add('btn-danger','bg-danger');
            thisButton.disabled = true;  
            equ=setInterval(animateEqualizer, 500);
          }).catch((error) => {
            Swal.fire({
                      icon: 'error',
                      title: 'دسترسی به میکروفن',                        
                      confirmButtonText: 'بله',
                      text:"اولیای {{session('User')->FullName}} عزیز \n  اجازه دسترسی به میکروفن داده نشده است "

                  });
          }); 
        }
        else
        {
          Swal.fire({
                      icon: 'error',
                      title: 'دسترسی به میکروفن',                        
                      confirmButtonText: 'بله',
                      text:"اولیای {{session('User')->FullName}} عزیز \n دسترسی به میکروفن امکان ندارد. لطفا فایل ضبط شده خود را ارسال کنید"

                  });
        }
      }
      
  } 

  function stopRecording(thisButton) 
  { 

    recording=0;
    // Stop the recording 
    if(window.mediaRecorder)
    window.mediaRecorder.stop(); 

    // Stop all the tracks in the 
    // received media stream 
    if(window.mediaStream)
    window.mediaStream.getTracks() 
    .forEach((track) => { 
      track.stop(); 
    }); 
    sendVoicebtn.classList.remove('d-none');
    thisButton.classList.add('btn-dark','bg-dark');
      thisButton.classList.remove('btn-danger','bg-danger');
      clearInterval(equ);
  } 
  function delvoice()
  {
    blobsAduio=null;
    sendVoicebtn.classList.add('d-none');
    record.classList.remove('d-none');
          prev.classList.add('d-none');
          bars.forEach((bar, index) => {
          bar.style.height = '0px';
        });
        playerRecord.currentTime=0;
        progressUpdate=1;
        playerRecord.src='';
        playedRecord.style.width ='0%';
  }
        
        
      document.querySelectorAll("audio[id^='player']").forEach(function(itm){
        var id=itm.id.split('player')[1];
        itm.addEventListener("timeupdate", function() {
          const duration = itm.duration;
          const currentTime = itm.currentTime;
          const progress = (currentTime / duration) * 100;
          document.getElementById('played'+id).style.width = progress + "%";
          if(progressUpdate)
          document.getElementById('progress'+id).value = itm.currentTime ;
          else
          progressUpdate=1;
        });
      itm.addEventListener("play", function() {
        document.getElementById('playericon'+id).classList.add('fa-pause');
            document.getElementById('playericon'+id).classList.remove('fa-play');
        });
      itm.addEventListener("pause", function() {
        document.getElementById('playericon'+id).classList.remove('fa-pause');
            document.getElementById('playericon'+id).classList.add('fa-play');
        });
      itm.addEventListener("end", function() {
        document.getElementById('playericon'+id).classList.remove('fa-pause');
            document.getElementById('playericon'+id).classList.add('fa-play');
            document.getElementById('progress'+id).value = 0 ;
        });
      });
      
        
  function sendVoice(obj)
    {
      obj.disabled=true;
      obj.classList.add('disabled');
      emojiBox.classList.add('d-none');
      var file=document.getElementById('playerRecord').src;
      if(file)
      {
        var upformData = new FormData(document.getElementById('frm3'));
        upformData.append('voice', blobsAduio, 'voice.mp3');

        
        upformData.append('Resiver', '8');
        upformData.append('Sender', '{{session('User')->Id}}');
        
        upformData.append('SellerId', '{{$user->SellerId??$user->SupportId}}');
        if(replyId)
        upformData.append('Parent', replyId);

          var data={Body:'',
          Date:"",Date2:"",
          File:"_voice__",
          Logo:"{{ asset('img/user.png') }}",
          Parent:replyId??null,
          ResiverId:"8",
          Sender:"{{session('User')->FullName}}",
          SenderId:"{{session('User')->Id}}",
          Time:"",chatId:"no"};
          
          var date = new Date();
          data.Time = new Date().toLocaleDateString("fa-IR", { hour: '2-digit', minute: '2-digit',second:'2-digit' }).split(',')[1];
          data.Date = date.toLocaleDateString("fa-IR", { day: "2-digit", month: "long" });
          data.Date2="امروز";
          recordVoice.close();
          obj.disabled=false;
          obj.classList.remove('disabled');
          //showmessages(data,1);
          
            const url='{{route("direct.send")}}';
          
          Swal.fire({
                title:"در حال ارسال پیام",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });   
        axios.post(url, upformData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
        .then(response => { 
          recordVoice.close();
          //msg_no.remove();
          URL.revokeObjectURL(document.getElementById('playerRecord'));          
          
          rmReply();
          //showmessages(response.data);
          
           obj.classList.remove('disabled');
            obj.disabled=false;
          })
        .catch(error => {
            console.log(error);

            /*msg_no.querySelector('.fa-spinner').classList.add("fa-circle-exclamation","text-danger"); 
            msg_no.querySelector('.fa-spinner').classList.remove("fa-spinner"); 
            
            var cancelDiv = document.createElement("div");
            cancelDiv.classList.add("d-flex", "gap-1");
            cancelDiv.onclick = function() {
              msg_no.remove();
            };*/
           /* cancelDiv.onmouseover = function() {
              document.getElementById("cancelDivno").classList.remove("d-none");
            };
            cancelDiv.onmouseout = function() {
              document.getElementById("cancelDivno").classList.add("d-none");
            };*/

            /*var cancelIcon = document.createElement("i");
            cancelIcon.classList.add("fa", "fa-trash");
            cancelDiv.appendChild(cancelIcon);

            var cancelTextDiv = document.createElement("div");
            cancelTextDiv.id = "divcancelno" ;
            cancelTextDiv.classList.add("toolsDiv", "d-none");
            cancelTextDiv.innerHTML = "حذف";
            cancelDiv.appendChild(cancelTextDiv);
            divtools_no.innerHTML='';
            divtools_no.appendChild(cancelDiv);*/

            recordVoice.show();
            
            rmReply();
            
            obj.disabled=false;
            obj.classList.remove('disabled');
            Swal.fire({
                        icon: 'error',
                        title: 'پیام ارسال نشد',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                         html:"مشکل پیش آمده دوباره تلاش کنید",

                    });
         });
      }
      else
      {
        Swal.fire({
                        icon: 'error',
                        title: 'خطا ',                        
                        confirmButtonText: 'بله',
                        text:"اولیای {{session('User')->FullName}} عزیز \n ابتدا صدای خود را ضبط کنید"
                         

                    });
      }
        
         
      
      
    }
    
  
  @if(in_array(last($dates??[]),['امروز',jdate()->format('d F')]))
  var preSender={{$pre}};
  @else
  var preSender=0;
  @endif
    
   
</script>
<script>
  function videoPlay(id)
  {
    var video = document.getElementById('Vplayer'+id);
    document.getElementById('videoDiv'+id).classList.add('d-none');
    video.classList.remove('d-none');
    if(video.readyState=== 0)
    {      
      video.src = video.children[0].getAttribute('data-src');
      video.load();
      video.play();
    }
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    }
    
    video.addEventListener('play', function(event) {
      video.style.objectFit='contain';
    });
    video.addEventListener('pause', function(event) {
      video.style.objectFit='cover';
    });
    video.addEventListener('end', function(event) {
      video.style.objectFit='cover';
      if (document.fullscreenElement === video ||
      document.webkitFullscreenElement === video ||
      document.mozFullscreenElement === video ||
      document.msFullscreenElement === video)
      {
        document.exitFullscreen();
        /*video.classList.add('d-none');
        document.getElementById('videoDiv'+id).classList.remove('d-none');*/
      }
      
    });
  }
   function showprewview(obj)
    {
        var files=obj.files;
        if(files.length)
        {       
          var fileSize = files[0].size /1024/1024; 
          if (fileSize <= 100) 
          {
            document.getElementById('dialogFile').show();      
            document.getElementById('prevNAME').textContent=files[0].name; 
            var fileSizeInKB = files[0].size / 1024;
            var fileSizeInMB = fileSizeInKB / 1024;   
            if (fileSizeInMB < 1) 
            fileSize= fileSizeInKB.toFixed(2) + ' KB';
            else
            fileSize=fileSizeInMB.toFixed(2) + ' MB';
            document.getElementById('prevSIZE').textContent=fileSize;
            msg2.value=msgtxt.value;
          }
          else
          {
            document.getElementById('dialogFile').close();  
            obj.value='';fileSize = 0;
            Swal.fire({
                icon: 'error',
                title: 'توجه',                
                confirmButtonText: 'بله',
                text:"اولیای {{session('User')->FullName}} عزیز \n فایل ارسالی بایستی کمتر از 100 مگ باشد"
            });
          }
        } 
        else
        document.getElementById('dialogFile').close();    
    }
    function updatemsg(obj)
    {
      obj.disabled=true;
      obj.classList.add('disabled');
      emojiBox.classList.add('d-none');
      var msg=msgtxt.value;
      msgtxt.value=msg2.value='';
      
      if(msg)
      {
        var upformData = new FormData(document.getElementById('frm3'));
        
        upformData.append('Body', msg);
        if(replyId)
        upformData.append('Id', replyId);

        
        upformData.append('Resiver', '8');
        upformData.append('SenderId', '{{$user->Id}}');


        elemEdit=document.getElementById('msg_'+replyId) ;
        elemEdit.querySelector('.fa-check , .fa-check-double').classList.add("fa-spinner"); 
        elemEdit.querySelector('.fa-check , .fa-check-double').classList.remove("fa-check" , "fa-check-double"); 
        document.getElementById('divtools_'+replyId).innerHTML='';

        axios.post('{{route("direct.update")}}', upformData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
        .then(response => { 
            obj.disabled=false;
            obj.classList.remove('disabled');
            rmReply();
          })
        .catch(error => {
            console.log(error);
            var msgedit=msgs.filter(function(item){if(item.Id==replyId) return item;});
            
            elemEdit=document.getElementById('msg_'+replyId) ;
            if(parseInt(msgedit[0].Read))
            elemEdit.querySelector('.fa-spinner').classList.add("fa-check-double"); 
            else
            elemEdit.querySelector('.fa-spinner').classList.add("fa-check"); 
            elemEdit.querySelector('.fa-spinner').classList.remove("fa-spinner"); 
            var divtools=document.getElementById('divtools_'+replyId);
            {
              if (uId == parseInt(msgedit[0].SenderId??msgedit[0].Sender))
              {
                var deleteDiv = document.createElement("div");
                deleteDiv.classList.add("d-flex", "gap-1");
                if (uId == parseInt(msgedit[0].ReceiverId??msgedit[0].Resiver) )
                deleteDiv.classList.add("flex-lg-row-reverse");
                deleteDiv.onclick = function() {
                  removemsg(msgedit[0].chatId??msgedit[0].Id);
                };
                
                var trashIcon = document.createElement("i");
                trashIcon.classList.add("fa", "fa-trash");
                deleteDiv.appendChild(trashIcon);

                var deleteTextDiv = document.createElement("div");
                deleteTextDiv.id = "divtrash" + msgedit[0].chatId??msgedit[0].Id;
                deleteTextDiv.classList.add("toolsDiv", "d-none");
                deleteTextDiv.innerHTML = "حذف";
                deleteDiv.appendChild(deleteTextDiv);

                divtools.appendChild(deleteDiv);

              if (msgedit[0].Message) 
              {
                var editDiv = document.createElement("div");
                editDiv.classList.add("d-flex", "gap-1");
                if (uId == parseInt(msgedit[0].ReceiverId??msgedit[0].Resiver))
                  editDiv.classList.add("flex-lg-row-reverse");
                editDiv.onclick = function() {
                  editmsg(msgedit[0].chatId??msgedit[0].Id);
                };
               /* editDiv.onmouseover = function() {
                  document.getElementById("divpencil" + msgedit[0].chatId??msgedit[0].Id).classList.remove("d-none");
                };
                editDiv.onmouseout = function() {
                  document.getElementById("divpencil" + msgedit[0].chatId??msgedit[0].Id).classList.add("d-none");
                };*/
                
                var pencilIcon = document.createElement("i");
                pencilIcon.classList.add("fa", "fa-pencil");
                editDiv.appendChild(pencilIcon);
                
                var editTextDiv = document.createElement("div");
                editTextDiv.id = "divpencil" + msgedit[0].chatId??msgedit[0].Id;
                editTextDiv.classList.add("toolsDiv", "d-none");
                editTextDiv.innerHTML = "ویرایش";
                editDiv.appendChild(editTextDiv);

                divtools.appendChild(editDiv);


              }
            }
            
            if(msgedit[0].Message)
            {
              var copyDiv = document.createElement("div");
                copyDiv.classList.add("d-flex", "gap-1");
                if (uId == parseInt(msgedit[0].ReceiverId??msgedit[0].Resiver))
                  copyDiv.classList.add("flex-row-reverse");
                copyDiv.onclick = function() {
                  copymsg(msgedit[0].chatId??msgedit[0].Id);
                };
               /* copyDiv.onmouseover = function() {
                  document.getElementById("divcopy" + msgedit[0].chatId??msgedit[0].Id).classList.remove("d-none");
                };
                copyDiv.onmouseout = function() {
                  document.getElementById("divcopy" + msgedit[0].chatId??msgedit[0].Id).classList.add("d-none");
                };*/
                
                var copyIcon = document.createElement("i");
                copyIcon.classList.add("fa", "fa-copy");
                copyDiv.appendChild(copyIcon);
                
                var copyTextDiv = document.createElement("div");
                copyTextDiv.id = "divcopy" + msgedit[0].chatId??msgedit[0].Id;
                copyTextDiv.classList.add("toolsDiv", "d-none");
                copyTextDiv.innerHTML = "کپی";
                copyDiv.appendChild(copyTextDiv);

                divtools.appendChild(copyDiv);
            }
            var replyDiv = document.createElement("div");
            replyDiv.classList.add("d-flex", "gap-1");
            if (uId == parseInt(msgedit[0].ReceiverId??msgedit[0].Resiver) )
            replyDiv.classList.add("flex-row-reverse");
            replyDiv.onclick = function() {
              replymsg(msgedit[0].chatId??msgedit[0].Id);
            };
            /*replyDiv.onmouseover = function() {
              document.getElementById("divreply" + msgedit[0].chatId??msgedit[0].Id).classList.remove("d-none");
            };
            replyDiv.onmouseout = function() {
              document.getElementById("divreply" + msgedit[0].chatId??msgedit[0].Id).classList.add("d-none");
            };*/

            var replyIcon = document.createElement("i");
            replyIcon.classList.add("fa", "fa-reply");
            replyDiv.appendChild(replyIcon);

            var replyTextDiv = document.createElement("div");
            replyTextDiv.id = "divreply" + msgedit[0].chatId??msgedit[0].Id;
            replyTextDiv.classList.add("toolsDiv", "d-none");
            replyTextDiv.innerHTML = "پاسخ";
            replyDiv.appendChild(replyTextDiv);

            divtools .appendChild(replyDiv);

                  
        }
            setMenu([document.getElementById('msg_'+replyId)]);
            
            rmReply();
            obj.disabled=false;
            obj.classList.remove('disabled');
            Swal.fire({
                        icon: 'error',
                        title: 'پیام ویرایش نشد',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                         html:"مشکل پیش آمده دوباره تلاش کنید",

                    });
         });
         
      }
      else
      {
        obj.disabled=false;obj.classList.remove('disabled');msgtxt.focus();
      }
      
    }
    function copymsg(msgid)
    {
      var msg=msgs.filter(function(item){if(item.Id==msgid) return item;});
      if(msg[0].Message)
      {
        const elem = document. createElement('textarea');
        elem. value = msg[0].Message;
        document. body. appendChild(elem);
        elem. select();
        document. execCommand('copy');
        document. body. removeChild(elem);
        Swal.fire('انجام شد','اولیای {{session('User')->FullName}}  عزیز، پیام انتخابی کپی شد','success');  

      }      
    }
    function removemsg(msgid)
    {
      Swal.fire({
                title: 'حذف پیام',
                text: "اولیای {{session('User')->FullName}}  عزیز، از حذف این پیام اطمینان دارید؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'نه',
            }).then((result) => {
                if (result.isConfirmed) {
                  var upformData = new FormData(document.getElementById('frm3'));
                      upformData.append('Id', msgid);

                     upformData.append('Resiver', '8');
                     upformData.append('SenderId', '{{$user->Id}}');
                                  
                      axios.post('{{route("direct.delete")}}', upformData, {
                      headers: {
                          'Content-Type': 'multipart/form-data'
                      }
                      })
                      .then(response => { 
                        /*document.getElementById('msg_'+msgid).remove();
                        var index=msgs.findIndex(function(item){return item.Id==msgid;});
                        var msg=msgs[index];msgs.splice(index,1);
                       
                        if(chatBox.childElementCount<=1 )
                        {
                          chatBox.innerHTML='';
                          dates=[];
                          preSender=0;
                        }
                        var items=msgs.filter(function(item){return item.Date2==msg.Date2;});
                        msg.Date2=msg.Date2.replace(/[۰-۹]/g, (d) => String.fromCharCode(d.charCodeAt(0) - 1728));
                        if(items.length<1)
                        chatBox.querySelectorAll(".datechat").forEach(function(elm){if(elm.innerText==msg.Date2) elm.remove();})
                         */
                         /*chatBox.innerHTML='';
                        dates=[];
                          preSender=0;
                        showAllmessages(response.data.msgs);*/
                        })
                      .catch(error => {
                          console.log(error);
                          rmReply();
                          Swal.fire({
                                      icon: 'error',
                                      title: 'پیام حذف نشد',                        
                                      confirmButtonText: 'بله',
                                      //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                      html:"مشکل پیش آمده دوباره تلاش کنید",

                                  });
                      });
                }
            });
      
      
    }
    function sendmsg(obj,msgBox=0)
    {
      obj.disabled=true;
      obj.classList.add('disabled');
      emojiBox.classList.add('d-none');
      var file=fileatt.files;
      if(msgBox)
      var msg=msg2.value;
      else
      var msg=msgtxt.value;
      msgtxt.value=msg2.value='';
      
      if(msg || file.length>0)
      {
        var upformData = new FormData(document.getElementById('frm3'));
        if(file.length)
        upformData.append('file', file[0]);
        if(msg)
        upformData.append('Body', msg);
        if(replyId)
        upformData.append('Parent', replyId);

       
        upformData.append('Resiver', '8');
        upformData.append('Sender', '{{$user->Id}}');
        upformData.append('SellerId', '{{$user->SellerId??$user->SupportId}}');
        
        
            Swal.fire({
                title:"در حال ارسال پیام",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });   
        axios.post('{{route("direct.send")}}', upformData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
        }).then(response => { 
            rmReply();
            obj.disabled=false;
            obj.classList.remove('disabled');
          })
        .catch(error => {
            console.log(error);
            rmReply();
            if(msgBox)
            {
              msg2.value=msg;
              dialogFile.show();
            }
            else
            msgtxt.value=msg;
            obj.disabled=false;
            obj.classList.remove('disabled');
            Swal.fire({
                        icon: 'error',
                        title: 'پیام ارسال نشد',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                         html:"مشکل پیش آمده دوباره تلاش کنید",

                    });
         });
         
      }
      else
      {
        obj.disabled=false;obj.classList.remove('disabled');msgtxt.focus();
      }
      
    }
   function showmessages(data,sending=0)
   {
        if(!dates.includes(data.Date2))
        {
          var datechat=document.createElement("h6");
          datechat.textContent=data.Date2;
          datechat.classList.add("datechat");
          chatBox.appendChild(datechat);
          dates.push(data.Date2);
        }
    var div=document.createElement("div");
        div.id="msg_"+data.chatId;
        div.className = "col-md-12 d-flex";
        if (uId == data.ReceiverId)
        div.classList.add("flex-row-reverse");
        if (preSender != data.SenderId)
        div.classList.add("mt-2");
        /*var innerDiv1 = document.createElement("div");
        innerDiv1.style.textAlign = "left";*/
        var img = document.createElement("img");
        img.src = "{{ asset('img/user.png') }}";
        img.className = "img-circle";

        if (preSender == data.SenderId)
          img.classList.add("opacity-0");
        if (uId != data.ReceiverId)
        img.classList.add("senderImg"); 

        //innerDiv1.appendChild(img);
        div.appendChild(img);
      
      
      var trig = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      trig.setAttribute("width","10");
      trig.setAttribute("height","10");
      
          
        if (preSender != data.SenderId)
        {
          var polygon = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
          if (uId != data.ReceiverId) 
          {
          trig.classList.add("STriangle");
            polygon.setAttribute('points',"0,0 0,10 10,0");
            polygon.setAttribute('fill',"#fff");
          }      
          else
          {
            trig.classList.add("RTriangle");
            polygon.setAttribute('points',"0,0 10,0 10,10");
            polygon.setAttribute('fill',"#FEF3D2");
          }
          trig.appendChild(polygon);
        }
        
        div.appendChild(trig);

        var innerDiv2 = document.createElement("div");
        if (uId != data.ReceiverId) 
          if (preSender == data.SenderId)
            innerDiv2.classList.add("sender","preSender");
          else
            innerDiv2.classList.add("sender");
        else
          if (preSender == data.SenderId)
            innerDiv2.classList.add("resiver","preResiver");
          else
            innerDiv2.classList.add("resiver");
        
        innerDiv2.classList.add("col-md-6","col-8","row");
        var innerDiv3 = document.createElement("div");
        innerDiv3.className = "col-md-12 text-right";
        innerDiv3.style.wordBreak = "break-word";
        if (preSender != data.SenderId)
        {
          var h6 = document.createElement("b");
          h6.textContent = data.SenderId;
          innerDiv3.appendChild(h6);
        }

        if(data.Parent)
        {
          var parentDiv=document.createElement('div');
          parentDiv.classList.add("col-md-12","text-right","Parent");
          var parentDiv2=document.createElement('div');
          var msg=msgs.filter(function(item){if(item.Id==data.Parent) return item;});
          if(msg.length)
          {
            if(msg[0].Message)
            {
            var body=msg[0].Message.replace("\n"," ").substring(0,20);;
            if(msg[0].Message.replace("\n"," ").length>20)
            body+='...';
            }
            var file=msg[0].File;
            var sn=msg[0].SenderName??msg[0].Sender;
            body=(body)?body:((file.includes('_voice__'))?"پیام صوتی":'رسانه');
            parentDiv2.innerHTML="<b>"+sn+"</b><p>"+body+"</p>";
            parentDiv.appendChild(parentDiv2);
            innerDiv3.appendChild(parentDiv);
          }
          
          
        }


        if (data.Message) 
        {
          var p = document.createElement("p");
          p.innerHTML = data.Message.replace("\n","<br>");
          innerDiv3.appendChild(p);
          if (data.File) 
          {
              var button = document.createElement("button");
              button.className = "pull-left fa fa-download btn ";
              if(sending)
              {
                button.disabled=true;
                button.classList.add('disabled');
              }
              
              button.addEventListener("click",function() {
                          window.open(data.File,'_blank');
                        });
              innerDiv3.appendChild(button);
            
          }
        }
        else 
        {
          if(data.File.includes('_voice__'))
          { 
            const divContainer = document.createElement("div");
            divContainer.classList.add("d-flex","gap-2","m-0","py-1");

            const AudioPlayer = document.createElement("audio");
            AudioPlayer.classList.add("d-none");
            AudioPlayer.id = "player"+data.chatId;
            AudioPlayer.src = data.File;

            AudioPlayer.addEventListener("timeupdate", function() {
              const duration = AudioPlayer.duration;
              const currentTime = AudioPlayer.currentTime;
              const progress = (currentTime / duration) * 100;
              document.getElementById('played'+data.chatId).style.width = progress + "%";
              if(progressUpdate)
              document.getElementById('progress'+data.chatId).value = AudioPlayer.currentTime ;
              else
              progressUpdate=1;
            });
            AudioPlayer.addEventListener("play", function() {
            document.getElementById('playericon'+data.chatId).classList.add('fa-pause');
                document.getElementById('playericon'+data.chatId).classList.remove('fa-play');
            });
            AudioPlayer.addEventListener("pause", function() {
            document.getElementById('playericon'+data.chatId).classList.remove('fa-pause');
                document.getElementById('playericon'+data.chatId).classList.add('fa-play');
            });
            AudioPlayer.addEventListener("end", function() {
            document.getElementById('playericon'+data.chatId).classList.remove('fa-pause');
                document.getElementById('playericon'+data.chatId).classList.add('fa-play');
                document.getElementById('progress'+data.chatId).value = 0 ;
            });

                    
            const wavePlayerContainer = document.createElement("div");
            wavePlayerContainer.classList.add("bg-light","d-flex","justify-content-center","waveplayer");

            const waveContainer = document.createElement("div");
            waveContainer.className = "wave";
            waveContainer.id = "wave"+data.chatId;

            const playedContainer = document.createElement("div");
            playedContainer.className = "played";
            playedContainer.id = "played"+data.chatId;

            const progressInput = document.createElement("input");
            progressInput.type = "range";
            progressInput.value = "0";
            progressInput.step = "0.1";
            progressInput.onchange = function() {
              changeCurrentTime(this.value,data.chatId);
            };
            progressInput.className = "progress";
            progressInput.id = "progress"+data.chatId;

            waveContainer.appendChild(playedContainer);
            waveContainer.appendChild(progressInput);

            wavePlayerContainer.appendChild(waveContainer);

            const playButton = document.createElement("div");
            playButton.classList.add("circle", "btn", "btn-dark", "bg-dark", "m-auto");
            if(sending)
              {
                playButton.disabled=true;
                playButton.classList.add('disabled');
              }
            playButton.onclick =function() {
              playAudio(data.chatId);
            };

            const playIcon = document.createElement("i");
            playIcon.classList.add("fa", "fa-play");
            playIcon.id = "playericon"+data.chatId;

            playButton.appendChild(playIcon);

            

            //divContainer.appendChild(deleteButton);
            divContainer.appendChild(AudioPlayer);
            divContainer.appendChild(wavePlayerContainer);
            divContainer.appendChild(playButton);

            innerDiv3.appendChild(divContainer);
          }
          else if(data.File.includes('_movie__'))
          {    
            const videoDiv = document.createElement("div");
            videoDiv.className = "videofile";
            videoDiv.id = "videoDiv"+data.chatId;
            videoDiv.style.backgroundColor = "#fff";

            const img = document.createElement("img");
            img.style.cursor = "pointer";
            img.src = "{{asset('img/details/play.png')}}";
            img.alt = "Image";
            img.width = 70;
            img.height = 70;
            if(sending)
              {
                img.disabled=true;
                img.classList.add('disabled');
              }
            img.onclick =function() {videoPlay(data.chatId)};

            videoDiv.appendChild(img);

            const video = document.createElement("video");
            video.controls = true;
            video.poster = "{{asset('img/Logored.png')}}";
            video.classList.add("videoplayer","d-none");
            video.id = "Vplayer"+data.chatId;

            const source = document.createElement("source");
            source.id = "VSource"+data.chatId;
            source.setAttribute("data-src", data.File);
            source.type = "video/"+data.File.split('.').pop();


            video.appendChild(source);

          // innerDiv2.appendChild(videoPlayer);
            innerDiv3.appendChild(videoDiv);
            innerDiv3.appendChild(video);
          }
          else if(data.File.includes('_image__'))
          {    
            const divElement = document.createElement("div");
            divElement.classList.add("picfile");
            divElement.style.backgroundImage ='url('+data.File+')';

            const linkElement = document.createElement("a");
            linkElement.href = data.File;
            linkElement.target = "_blank";
            linkElement.download = data.File.split("{{'Direct/user_'.$user->Id.'/'}}")[1];

            const imgElement = document.createElement("img");
            imgElement.src = "{{asset('img/details/download.png')}}";
            imgElement.alt = "FirstClassChallImage";
            imgElement.width = 70;
            imgElement.height = 70;
            if(sending)
              {
                imgElement.disabled=true;
                imgElement.classList.add('disabled');
              }
            linkElement.appendChild(imgElement);
            divElement.appendChild(linkElement);
            
            innerDiv3.appendChild(divElement);
          }
          else
          {
            var div2 = document.createElement("div");
            div2.classList.add('d-flex','gap-1');
            div2.style.cursor = "pointer";
            div2.style.wordBreak = "break-word";
            div2.style.padding = "10px";
            if(sending)
              {
                div2.disabled=true;
                div2.classList.add('disabled');
              }
            div2.addEventListener("click",function() {
                          window.open(data.File,'_blank');
                        });
            var i = document.createElement("i");
            i.className = "fa fa-2x fa-file fa-regular";
            var b = document.createElement("b");
            b.dir = "ltr";
            b.style.fontSize= "5pt";
            b.textContent = data.File.split("{{'Direct/user_'.$user->Id.'/'}}")[1];
            div2.appendChild(i);
            div2.appendChild(b);
            innerDiv3.appendChild(div2);
          }
          
        }
        innerDiv2.appendChild(innerDiv3);
        var innerDiv4 = document.createElement("div");
        if (uId != data.ReceiverId)
          innerDiv4.className = "p-0 text-right";
        else
          innerDiv4.className = "text-left";
        
        if (uId != data.ReceiverId) 
        {
          var ion = document.createElement("i");
          ion.className = "fa";
          if(sending)
          {           
            ion.classList.add("fa-spinner");
          }
          else
          {
            if (parseInt(data.Read))
            {
              ion.classList.add("fa-check-double");
              ion.classList.add("px-1","text-3b407a");
            }
            else 
              ion.classList.add("fa-check");
          }
          

          innerDiv4.appendChild(ion);
        }
        var label = document.createElement("label");
        label.className = "fw-bolder number";
        label.textContent = data.Time;
        innerDiv4.appendChild(label);
        innerDiv2.appendChild(innerDiv4);
        div.appendChild(innerDiv2);
        
        var divtools  = document.createElement("div");
        divtools .classList.add("tools","d-none", "d-flex","flex-wrap-reverse", "gap-2", "h-100", "my-auto", "p-1");
        divtools .id="divtools_"+data.chatId;
        if(sending)
        {
            /*var cancelDiv = document.createElement("div");
            cancelDiv.classList.add("d-flex", "gap-1");
            cancelDiv.onclick = function() {
              div.remove();
            };
            cancelDiv.onmouseover = function() {
              document.getElementById("cancelDiv" + data.chatId).classList.remove("d-none");
            };
            cancelDiv.onmouseout = function() {
              document.getElementById("cancelDiv" + data.chatId).classList.add("d-none");
            };

            var cancelIcon = document.createElement("i");
            cancelIcon.classList.add("fa", "fa-close");
            cancelDiv.appendChild(cancelIcon);

            var cancelTextDiv = document.createElement("div");
            cancelTextDiv.id = "divcancel" + data.chatId;
            cancelTextDiv.classList.add("toolsDiv", "d-none");
            cancelTextDiv.innerHTML = "لغو ارسال";
            cancelDiv.appendChild(cancelTextDiv);

            divtools .appendChild(cancelDiv);*/
        }
        else
        {
          if (uId == data.SenderId)
          {
              var deleteDiv = document.createElement("div");
              deleteDiv.classList.add("d-flex", "gap-1");
              if (uId == data.ReceiverId) 
              deleteDiv.classList.add("flex-row-reverse");
              deleteDiv.onclick = function() {
                removemsg(data.chatId);
              };
              /*deleteDiv.onmouseover = function() {
                document.getElementById("divtrash" + data.chatId).classList.remove("d-none");
              };
              deleteDiv.onmouseout = function() {
                document.getElementById("divtrash" + data.chatId).classList.add("d-none");
              };*/
              
              var trashIcon = document.createElement("i");
              trashIcon.classList.add("fa", "fa-trash");
              deleteDiv.appendChild(trashIcon);

              var deleteTextDiv = document.createElement("div");
              deleteTextDiv.id = "divtrash" + data.chatId;
              deleteTextDiv.classList.add("toolsDiv", "d-none");
              deleteTextDiv.innerHTML = "حذف";
              deleteDiv.appendChild(deleteTextDiv);

              divtools.appendChild(deleteDiv);

            if (data.Message) 
            {
              var editDiv = document.createElement("div");
              editDiv.classList.add("d-flex", "gap-1");
              if (uId == data.ReceiverId)
                editDiv.classList.add("flex-row-reverse");
              editDiv.onclick = function() {
                editmsg(data.chatId);
              };
              /*editDiv.onmouseover = function() {
                document.getElementById("divpencil" + data.chatId).classList.remove("d-none");
              };
              editDiv.onmouseout = function() {
                document.getElementById("divpencil" + data.chatId).classList.add("d-none");
              };*/
              
              var pencilIcon = document.createElement("i");
              pencilIcon.classList.add("fa", "fa-pencil");
              editDiv.appendChild(pencilIcon);
              
              var editTextDiv = document.createElement("div");
              editTextDiv.id = "divpencil" + data.chatId;
              editTextDiv.classList.add("toolsDiv", "d-none");
              editTextDiv.innerHTML = "ویرایش";
              editDiv.appendChild(editTextDiv);

              divtools.appendChild(editDiv);
              
              
            }
          }
          
          if(data.Message)
          {
            var copyDiv = document.createElement("div");
              copyDiv.classList.add("d-flex", "gap-1");
              if (uId == data.ReceiverId)
                copyDiv.classList.add("flex-row-reverse");
              copyDiv.onclick = function() {
                copymsg(data.chatId);
              };
              /*copyDiv.onmouseover = function() {
                document.getElementById("divcopy" + data.chatId).classList.remove("d-none");
              };
              copyDiv.onmouseout = function() {
                document.getElementById("divcopy" + data.chatId).classList.add("d-none");
              };*/
              
              var copyIcon = document.createElement("i");
              copyIcon.classList.add("fa", "fa-copy");
              copyDiv.appendChild(copyIcon);
              
              var copyTextDiv = document.createElement("div");
              copyTextDiv.id = "divcopy" + data.chatId;
              copyTextDiv.classList.add("toolsDiv", "d-none");
              copyTextDiv.innerHTML = "کپی";
              copyDiv.appendChild(copyTextDiv);

              divtools.appendChild(copyDiv);
          }
          var replyDiv = document.createElement("div");
          replyDiv.classList.add("d-flex", "gap-1");
          if (uId == data.ReceiverId) 
          replyDiv.classList.add("flex-row-reverse");
          replyDiv.onclick = function() {
            replymsg(data.chatId);
          };
         /* replyDiv.onmouseover = function() {
            document.getElementById("divreply" + data.chatId).classList.remove("d-none");
          };
          replyDiv.onmouseout = function() {
            document.getElementById("divreply" + data.chatId).classList.add("d-none");
          };*/

          var replyIcon = document.createElement("i");
          replyIcon.classList.add("fa", "fa-reply");
          replyDiv.appendChild(replyIcon);

          var replyTextDiv = document.createElement("div");
          replyTextDiv.id = "divreply" + data.chatId;
          replyTextDiv.classList.add("toolsDiv", "d-none");
          replyTextDiv.innerHTML = "پاسخ";
          replyDiv.appendChild(replyTextDiv);

          divtools .appendChild(replyDiv);

          
        }

        div.appendChild(divtools);
        chatBox.appendChild(div);
        msgtxt.value='';
        fileprev_del.click();
        chatBox.scrollTo( chatBox.scrollHeight, chatBox.scrollHeight);
        if(!sending)
        {
        preSender=data.SenderId;
        data.msg.Date2=data.Date2;
        data.msg.SenderName=data.SenderId;
        data.msg.ResiverName=data.ReceiverId;
        data.msg.Time=data.Time;
        msgs.push(data.msg);
        }
        
        setMenu([div]);
   }
   function showAllmessages(messages)
   {
    msgs=[];
    var options = { day: "2-digit", month: "long" };
    var preDate=0;
    messages.forEach(function(data){
      
       var date = new Date(data.Date);
       data.Time = new Date(data.Date).toLocaleDateString("fa-IR", { hour: '2-digit', minute: '2-digit',second:'2-digit' }).split(',')[1];
       data.Date2 = date.toLocaleDateString("fa-IR", options);
       if(data.Date2==new Date().toLocaleDateString("fa-IR", options))
       data.Date2="امروز";
        
        if(!dates.includes(data.Date2))
        {
          var datechat=document.createElement("h6");
          datechat.textContent=data.Date2;
          datechat.classList.add("datechat");
          chatBox.appendChild(datechat);
          dates.push(data.Date2);
        }
        
        var div=document.createElement("div");
        div.id="msg_"+data.Id;
        div.className = "col-md-12 d-flex";
        if (uId == data.ReceiverId)
        div.classList.add("flex-row-reverse");
        if (preSender != data.SenderId)
        div.classList.add("mt-2");
        /*var innerDiv1 = document.createElement("div");
        innerDiv1.style.textAlign = "left";*/
        var img = document.createElement("img");
        img.src = "{{ asset('img/user.png') }}";
        img.className = "img-circle";

        if (preSender == data.SenderId && preDate==data.Date2)
          img.classList.add("opacity-0");
        if (uId != data.ReceiverId)
        img.classList.add("senderImg"); 

        //innerDiv1.appendChild(img);
        div.appendChild(img);
      
      
      var trig = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      trig.setAttribute("width","10");
      trig.setAttribute("height","10");
      
          
        if (preSender != data.SenderId ||  (preSender == data.SenderId && preDate!=data.Date2))
        {
          var polygon = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
          if (uId != data.ReceiverId) 
          {
          trig.classList.add("STriangle");
            polygon.setAttribute('points',"0,0 0,10 10,0");
            polygon.setAttribute('fill',"#fff");
          }      
          else
          {
            trig.classList.add("RTriangle");
            polygon.setAttribute('points',"0,0 10,0 10,10");
            polygon.setAttribute('fill',"#FEF3D2");
          }
          trig.appendChild(polygon);
        }
        
        div.appendChild(trig);

        var innerDiv2 = document.createElement("div");
        if (uId != data.ReceiverId) 
          if (preSender == data.SenderId)
            innerDiv2.classList.add("sender","preSender");
          else
            innerDiv2.classList.add("sender");
        else
          if (preSender == data.SenderId)
            innerDiv2.classList.add("resiver","preResiver");
          else
            innerDiv2.classList.add("resiver");
        
        innerDiv2.classList.add("col-md-6","col-8","row");
        var innerDiv3 = document.createElement("div");
        innerDiv3.className = "col-md-12 text-right";
        innerDiv3.style.wordBreak = "break-word";
        if (preSender != data.SenderId)
        {
          var h6 = document.createElement("b");
          h6.textContent = data.SenderName;
          innerDiv3.appendChild(h6);
        }
        if(data.Parent)
        {
          var parentDiv=document.createElement('div');
          parentDiv.classList.add("col-md-12","text-right","Parent");
          var parentDiv2=document.createElement('div');
          var msg=messages.filter(function(item){if(item.Id==data.Parent) return item;});
          if(msg.length)
          {
            if(msg[0].Message)
            {
              var body=msg[0].Message.replace("\n"," ").substring(0,20);
              if(msg[0].Message.replace("\n"," ").length>20)
              body+='...';
            }
              var file=msg[0].File;
            var sn=msg[0].SenderName;
            body=(body)?body:((file.includes('_voice__'))?"پیام صوتی":'رسانه');
            parentDiv2.innerHTML="<b>"+sn+"</b><p>"+body+"</p>";
            parentDiv.appendChild(parentDiv2);
            innerDiv3.appendChild(parentDiv);
          }
          
          
        }
        if (data.Message) 
        {
          var p = document.createElement("p");
          p.innerHTML = data.Message.replace("\n","<br>");
          innerDiv3.appendChild(p);
          if (data.File) 
          {
              var button = document.createElement("button");
              button.className = "pull-left fa fa-download btn ";
              button.addEventListener("click",function() {
                          window.open(data.File,'_blank');
                        });
              innerDiv3.appendChild(button);
            
          }
        }
        else 
        {
          if(data.File.includes('_voice__'))
          { 
            const divContainer = document.createElement("div");
            divContainer.classList.add("d-flex","gap-2","m-0","py-1");

            const AudioPlayer = document.createElement("audio");
            AudioPlayer.classList.add("d-none");
            AudioPlayer.id = "player"+data.Id;
            AudioPlayer.src = data.File;

            AudioPlayer.addEventListener("timeupdate", function() {
              const duration = AudioPlayer.duration;
              const currentTime = AudioPlayer.currentTime;
              const progress = (currentTime / duration) * 100;
              document.getElementById('played'+data.Id).style.width = progress + "%";
              if(progressUpdate)
              document.getElementById('progress'+data.Id).value = AudioPlayer.currentTime ;
              else
              progressUpdate=1;
            });
            AudioPlayer.addEventListener("play", function() {
            document.getElementById('playericon'+data.Id).classList.add('fa-pause');
                document.getElementById('playericon'+data.Id).classList.remove('fa-play');
            });
            AudioPlayer.addEventListener("pause", function() {
            document.getElementById('playericon'+data.Id).classList.remove('fa-pause');
                document.getElementById('playericon'+data.Id).classList.add('fa-play');
            });
            AudioPlayer.addEventListener("end", function() {
            document.getElementById('playericon'+data.Id).classList.remove('fa-pause');
                document.getElementById('playericon'+data.Id).classList.add('fa-play');
                document.getElementById('progress'+data.Id).value = 0 ;
            });

                    
            const wavePlayerContainer = document.createElement("div");
            wavePlayerContainer.classList.add("bg-light","d-flex","justify-content-center","waveplayer");

            const waveContainer = document.createElement("div");
            waveContainer.className = "wave";
            waveContainer.id = "wave"+data.Id;

            const playedContainer = document.createElement("div");
            playedContainer.className = "played";
            playedContainer.id = "played"+data.Id;

            const progressInput = document.createElement("input");
            progressInput.type = "range";
            progressInput.value = "0";
            progressInput.step = "0.1";
            progressInput.onchange = function() {
              changeCurrentTime(this.value,data.Id);
            };
            progressInput.className = "progress";
            progressInput.id = "progress"+data.Id;

            waveContainer.appendChild(playedContainer);
            waveContainer.appendChild(progressInput);

            wavePlayerContainer.appendChild(waveContainer);

            const playButton = document.createElement("div");
            playButton.classList.add("circle", "btn", "btn-dark", "bg-dark", "m-auto");
            playButton.onclick =function() {
              playAudio(data.Id);
            };

            const playIcon = document.createElement("i");
            playIcon.classList.add("fa", "fa-play");
            playIcon.id = "playericon"+data.Id;

            playButton.appendChild(playIcon);

            

            //divContainer.appendChild(deleteButton);
            divContainer.appendChild(AudioPlayer);
            divContainer.appendChild(wavePlayerContainer);
            divContainer.appendChild(playButton);

            innerDiv3.appendChild(divContainer);
          }
          else if(data.File.includes('_movie__'))
          {    
            const videoDiv = document.createElement("div");
            videoDiv.className = "videofile";
            videoDiv.id = "videoDiv"+data.Id;
            videoDiv.style.backgroundColor = "#fff";

            const img = document.createElement("img");
            img.style.cursor = "pointer";
            img.src = "{{asset('img/details/play.png')}}";
            img.alt = "Image";
            img.width = 70;
            img.height = 70;
            img.onclick =function() {videoPlay(data.Id)};

            videoDiv.appendChild(img);

            const video = document.createElement("video");
            video.controls = true;
            video.poster = "{{asset('img/Logored.png')}}";
            video.classList.add("videoplayer","d-none");
            video.id = "Vplayer"+data.Id;

            const source = document.createElement("source");
            source.id = "VSource"+data.Id;
            source.setAttribute("data-src", data.File);
            source.type = "video/"+data.File.split('.').pop();


            video.appendChild(source);

          // innerDiv2.appendChild(videoPlayer);
            innerDiv3.appendChild(videoDiv);
            innerDiv3.appendChild(video);
          }
          else if(data.File.includes('_image__'))
          {    
            const divElement = document.createElement("div");
            divElement.classList.add("picfile");
            divElement.style.backgroundImage ='url('+data.File+')';

            const linkElement = document.createElement("a");
            linkElement.href = data.File;
            linkElement.target = "_blank";
            linkElement.download = data.File.split("{{'Direct/user_'.$user->Id.'/'}}")[1];

            const imgElement = document.createElement("img");
            imgElement.src = "{{asset('img/details/download.png')}}";
            imgElement.alt = "FirstClassChallImage";
            imgElement.width = 70;
            imgElement.height = 70;

            linkElement.appendChild(imgElement);
            divElement.appendChild(linkElement);
            
            innerDiv3.appendChild(divElement);
          }
          else
          {
            var div2 = document.createElement("div");
            div2.classList.add('d-flex','gap-1');
            div2.style.cursor = "pointer";
            div2.style.wordBreak = "break-word";
            div2.style.padding = "10px";
            div2.addEventListener("click",function() {
                          window.open(data.File,'_blank');
                        });
            var i = document.createElement("i");
            i.className = "fa fa-2x fa-file fa-regular";
            var b = document.createElement("b");
            b.dir = "ltr";
            b.style.fontSize= "5pt";
            b.textContent = data.File.split("{{'Direct/user_'.$user->Id.'/'}}")[1];
            div2.appendChild(i);
            div2.appendChild(b);
            innerDiv3.appendChild(div2);
          }
          
        }
        innerDiv2.appendChild(innerDiv3);
        var innerDiv4 = document.createElement("div");
        if (uId != data.ReceiverId)
          innerDiv4.className = "p-0 text-right";
        else
          innerDiv4.className = "text-left";
        
        if (uId != data.ReceiverId) 
        {
          var ion = document.createElement("i");
          ion.className = "fa";
          if (parseInt(data.Read))
          {
            ion.classList.add("fa-check-double");
            ion.classList.add("px-1","text-3b407a");
          }
          else 
            ion.classList.add("fa-check");

          innerDiv4.appendChild(ion);
        }
        var label = document.createElement("label");
        label.className = "fw-bolder number";
        label.textContent = data.Time;
        innerDiv4.appendChild(label);
        innerDiv2.appendChild(innerDiv4);
        div.appendChild(innerDiv2);

        var divtools  = document.createElement("div");
        divtools .classList.add("tools","d-none", "d-flex","flex-wrap-reverse", "gap-2", "h-100", "my-auto", "p-1");
        divtools .id="divtools_"+data.Id;
        if (uId == data.SenderId)
        {
          
          if (new Date(data.Date).setHours(new Date(data.Date).getHours() + 24) >= new Date()) 
          {
            var deleteDiv = document.createElement("div");
            deleteDiv.classList.add("d-flex", "gap-1");
            if (uId == data.ReceiverId) 
            deleteDiv.classList.add("flex-row-reverse");
            deleteDiv.onclick = function() {
              removemsg(data.Id);
            };
            /*deleteDiv.onmouseover = function() {
              document.getElementById("divtrash" + data.Id).classList.remove("d-none");
            };
            deleteDiv.onmouseout = function() {
              document.getElementById("divtrash" + data.Id).classList.add("d-none");
            };*/
            
            var trashIcon = document.createElement("i");
            trashIcon.classList.add("fa", "fa-trash");
            deleteDiv.appendChild(trashIcon);

            var deleteTextDiv = document.createElement("div");
            deleteTextDiv.id = "divtrash" + data.Id;
            deleteTextDiv.classList.add("toolsDiv", "d-none");
            deleteTextDiv.innerHTML = "حذف";
            deleteDiv.appendChild(deleteTextDiv);

            divtools.appendChild(deleteDiv);
          }
          if (new Date(data.Date).setHours(new Date(data.Date).getHours() + 24) >= new Date() && data.Message) 
          {
            var editDiv = document.createElement("div");
            editDiv.classList.add("d-flex", "gap-1");
            if (uId == data.ReceiverId)
              editDiv.classList.add("flex-row-reverse");
            editDiv.onclick = function() {
              editmsg(data.Id);
            };
            /*editDiv.onmouseover = function() {
              document.getElementById("divpencil" + data.Id).classList.remove("d-none");
            };
            editDiv.onmouseout = function() {
              document.getElementById("divpencil" + data.Id).classList.add("d-none");
            };*/
            
            var pencilIcon = document.createElement("i");
            pencilIcon.classList.add("fa", "fa-pencil");
            editDiv.appendChild(pencilIcon);
            
            var editTextDiv = document.createElement("div");
            editTextDiv.id = "divpencil" + data.Id;
            editTextDiv.classList.add("toolsDiv", "d-none");
            editTextDiv.innerHTML = "ویرایش";
            editDiv.appendChild(editTextDiv);

            divtools.appendChild(editDiv);
          }
        }
        
        if(data.Message)
          {
            var copyDiv = document.createElement("div");
            copyDiv.classList.add("d-flex", "gap-1");
            if (uId == data.ReceiverId)
              copyDiv.classList.add("flex-row-reverse");
            copyDiv.onclick = function() {
              copymsg(data.Id);
            };
            /*copyDiv.onmouseover = function() {
              document.getElementById("divcopy" + data.Id).classList.remove("d-none");
            };
            copyDiv.onmouseout = function() {
              document.getElementById("divcopy" + data.Id).classList.add("d-none");
            };*/
            
            var copyIcon = document.createElement("i");
            copyIcon.classList.add("fa", "fa-copy");
            copyDiv.appendChild(copyIcon);
            
            var copyTextDiv = document.createElement("div");
            copyTextDiv.id = "divcopy" + data.Id;
            copyTextDiv.classList.add("toolsDiv", "d-none");
            copyTextDiv.innerHTML = "کپی";
            copyDiv.appendChild(copyTextDiv);

            divtools.appendChild(copyDiv);
          }
        var replyDiv = document.createElement("div");
        replyDiv.classList.add("d-flex", "gap-1");
        if (uId == data.ReceiverId) 
        replyDiv.classList.add("flex-row-reverse");
        replyDiv.onclick = function() {
          replymsg(data.Id);
        };
        /*replyDiv.onmouseover = function() {
          document.getElementById("divreply" + data.Id).classList.remove("d-none");
        };
        replyDiv.onmouseout = function() {
          document.getElementById("divreply" + data.Id).classList.add("d-none");
        };*/

        var replyIcon = document.createElement("i");
        replyIcon.classList.add("fa", "fa-reply");
        replyDiv.appendChild(replyIcon);

        var replyTextDiv = document.createElement("div");
        replyTextDiv.id = "divreply" + data.Id;
        replyTextDiv.classList.add("toolsDiv", "d-none");
        replyTextDiv.innerHTML = "پاسخ";
        replyDiv.appendChild(replyTextDiv);

        divtools .appendChild(replyDiv);

        div.appendChild(divtools);

        chatBox.appendChild(div);
        msgtxt.value='';
        fileprev_del.click();
        preSender=data.SenderId;
        preDate=data.Date2;
        chatBox.scrollTo( chatBox.scrollHeight, chatBox.scrollHeight);
        msgs.push(data);

    });
    Swal.close();
    setMenu(document.querySelectorAll('div[id^="msg_"]'));
   }

  const ably2 = new Ably.Realtime.Promise('{{env('ABLY_KEY')}}');
    ably2.connection.once('connected');
  
    
    
    /*Seen Messages*/
    var channel2 = ably2.channels.get('Direct-Chat-Seen.8_'+uId);
    channel2.subscribe('DirectChatSeen', function(data) {          
      document.querySelectorAll('.fa-check').forEach(itm=>{
        itm.classList.remove('fa-check');
        itm.classList.add('fa-check-double','px-1','text-3b407a');
      }); 
    });


      /* Change Message Channel*/
      var channel4 = ably2.channels.get('DirectChat-Change-{{$user->Id}}');
    channel4.subscribe('DirectChatChange', function(data)
     {
      axios.post('{{route("direct.all",["Resiver"=>$user->Id])}}') .then(response =>
      {
        chatBox.innerHTML='';
        dates=[];
        preSender=0;
        showAllmessages(response.data.msgs);  
      });      
                         
        
    });
   
    setMenu(document.querySelectorAll('div[id^="msg_"]'));
    
  function setMenu(divmessagess)
  {
     divmessagess.forEach(element => {
      element.addEventListener("contextmenu", function(event) {
        event.preventDefault();
        var show=0;
        if(element.querySelector('.tools').classList.contains('d-none'))
        show=1;
        const tools=document.querySelectorAll('div[id^="divtools_"]');
          tools.forEach(elm => {
            elm.classList.add('d-none');
          });
          if(show)
          element.querySelector('.tools').classList.remove('d-none');
      });
      /*element.addEventListener("click", function(event) {
        event.preventDefault();
        var show=0;
        if(element.querySelector('.tools').classList.contains('d-none'))
        show=1;
        const tools=document.querySelectorAll('div[id^="divtools_"]');
          tools.forEach(elm => {
            elm.classList.add('d-none');
          });
          if(show)
          element.querySelector('.tools').classList.remove('d-none');
      });*/
    });
  }
 
    const elements = document.querySelectorAll('.sender');
    elements.forEach(element => {

      element.addEventListener("contextmenu", function(event) {
        /*event.preventDefault();
        if(document.getElementById("contextMenu"))
        document.getElementById("contextMenu").remove();

        var contextMenu = document.createElement("div");
        contextMenu.classList.add("context-menu");
  
        var deleteOption = document.createElement("div");
        deleteOption.classList.add("menu-option");
        deleteOption.textContent = "حذف پیام";
  
        var copyOption = document.createElement("div");
        copyOption.classList.add("menu-option");
        copyOption.textContent = "کپی پیام";
  
  
        contextMenu.appendChild(deleteOption);
        contextMenu.appendChild(copyOption);

        contextMenu.id='contextMenu';
        contextMenu.style.position = "absolute";
        contextMenu.style.left = event.X + "px";
        contextMenu.style.top = event.Y + "px";
  
        chatBox.appendChild(contextMenu);*/
        
      });
    });
   /* document.addEventListener("click", function() {
      if(document.getElementById("contextMenu"))
            document.getElementById("contextMenu").remove();
    });*/
</script>
@endsection