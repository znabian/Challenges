@extends('layouts.goldchall')
@section('style')<style>
    video
    {
      /* object-fit: fill; */
    }
    /* .container {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
    } */
    .btn-master {
        background: radial-gradient(#e7ce79, #c8ad5a);
        border: 1px solid #c5ab5a!important;
        border-radius: 14px!important;
        color: #393a3a!important;
        padding: 8px!important;
        width: 125px;
        font-size: 12pt!important;
        /* display: block!important; */
        /* margin: 10px auto!important; */
        /* margin-bottom: 0!important; */
    }
    #content {
                color: #535353;            
                max-height: 100vh;
                /* height: 88vh; */
                min-height: 100%;
                padding: 4vw;
                overflow: hidden;
               
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
        /* opacity: 0.25; */
        color: #86827e;
        font-weight: 900;
        font-family: 'PEYDA-BLACK';
        font-size: calc(3rem + 2.75vw);
    }
    .text-subtitle {
        font-weight: 900;
        color: #535353;
        font-size: calc(1.65rem + 1.2vw);
        /* padding-inline-start: 14px; */
        /* margin-right: 65px; */
        /* text-shadow: 2px 3px 3px #323030ad; */
    }
    
    .cardChall {
        font-size: 12pt;
        font-family: Peyda;
        line-height: 25px;
        text-align: justify;
        color: #f6f6f6;
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
           background-image: url("{{asset('img/child/home/back.png')}}");
            padding: 0!important; 
            /* background-size: cover; */
            background-attachment: fixed;
            background-color: #f6f6f6;
            background-blend-mode: darken;
            height: 100vh!important;
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
                 /* opacity:0!important; */
                }
            }
    
    .picfile {
        background-size: cover;
        background-repeat: no-repeat;
        height:13rem;/* 154px;*/
        background-color: #c50b08;
        background-blend-mode: darken;
        width: 100%;
        border-radius: 23px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 6px 10px -5px #1a18188f;
    }
    .playicon {
    
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
    }
    .blurEffect{
      filter: opacity(0.5);
        background-color: #c50b08;
    }
    .backcircle {
        position: absolute;
        display: block;
        justify-content: center;
        z-index: 0;
        background-color: #FFF5E6;
        border-radius: 50%;
        width: 300px;
        height: 300px;
        right: -28px;
        top: 32px;
    }
    .waveplayer {
        width: 100%;
        height: 58px;
        border-radius: 15px;
        padding: 5px;
        box-shadow: 0px 3px 5px 0px #c5c5c5;
        position: relative;
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
    .timeline
    {
      display: block!important;
      font-weight: bold;
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
            background-color: red;
            border-radius: 0 0 25% 25%;
            padding: 3%;
            margin-top: -1rem;
            margin-left: 8px;
            height: 0.5rem;
            width: 0.5rem;
            border: 1px dotted #910707;
    
            }
    </style>
    @endsection
    @section('content')   
    
        <div class="col-12 overflow-x-hidden overflow-y px-3 position-relative" style="height: 74vh">
          
          <div class="d-flex position-relative">
            <div class="backcircle"></div>
            
          <div class="position-relative pt-5  z-1">
              <h2 class="pt-3 text-center text-subtitle "  >
                {{$video['Title']}}
              </h2>
              <h6>{{$video['Body']}}</h6>
          </div>
          </div>
          <div class="position-relative ChallFile  z-1 px-3">
            @php
            $video['File']=strtr($video['File'],['http://85.208.255.101:8012/'=>'https://www.kakheroshd.ir:448/','http://185.116.161.39:8012/'=>'https://www.kakheroshd.ir:448/','http://dl5.erfankhoshnazar.ir/'=>'https://www.kakheroshd.ir:448/','http://dl4.erfankhoshnazar.com/'=>'https://www.kakheroshd.ir:448/RedCastleFileManager/']);            
            @endphp
            
            <div class="col-12 d-flex gap-2 justify-content-center mt-3">
             
              <div class="col-12 position-relative">
                <video id="videoplayer" poster="{{asset('img/logowhite.png')}}" class="videoRes embed-responsive-16by9 picfile " oncontextmenu="return false;"  controlsList="nodownload"  >
                <source data-src="{{$video['File']}}" type="video/mp4">
              </video>
              <span class="playicon"></span>
              </div>
              
            </div>
            
    
            
          </div>
          <div class="position-relative col-12 z-1 mt-4 px-3">
            
            <div class="cardChall" >
              <div class="card-body">
                
                <p>{{session('User')->Name}} عزیز این آموزش رو تا آخر ببین تا بتونی به آموزش های بعدی دسترسی داشته باشی                </p>
                  
              </div>
            </div>
          </div>
    
        </div>
        @endsection
@section('backUrl') 
{{route('gold.chall')}}
@endsection
@section('script')
<script>
    
    send_flag=false;
   
    
    if(document.getElementById('videoplayer'))
    {
        var videoElement = document.getElementById('videoplayer');
        videoElement.addEventListener('ended', updateUserdata);
        @if($mychall['Done']!=1)
        videoElement.addEventListener('play', startPlaying);
        @endif
        videoplayer.addEventListener('end', function(event) {
      
        if (document.fullscreenElement === videoplayer ||
        document.webkitFullscreenElement === videoplayer ||
        document.mozFullscreenElement === videoplayer ||
        document.msFullscreenElement === videoplayer)
        {
            document.exitFullscreen();
        }
        
        });
        
    }
    function updateUserdata()
    {
      if(!send_flag)
      {

         @if($mychall['Done']!=1)
        Swal.fire({
                  title:"کمی صبر کن",
                  html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                  icon:'info',
                  allowOutsideClick:false,
                  showConfirmButton:false,
                });
          axios({
          method: 'POST',
          url:'{{route('gold.chall.unlock')}}',
          data:{cid:'{{$mychall['Id']}}'},
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function ({data}) {
              if (data.status)
                {
                    Swal.fire({
                        icon: 'info',
                        title: '{{session('User')->FullName}}',                        
                        confirmButtonText: 'متوجه شدم',
                        text:"آفرین! الان میتونی قسمت بعدی رو ببینی",

                     });
                    return true;
              }
              else {
                  
                  Swal.fire('توجه',"دسترسی به قسمت بعدی صادر نشد یکبار دیگه فیلم رو ببین",'error');
                  return false;

              }
          })
          .catch(error => {
                  Swal.fire('توجه',"دسترسی به قسمت بعدی صادر نشد یکبار دیگه فیلم رو ببین",'error');
                  return false;
          });
          @endif
        send_flag=true;
       
      }
    }
    let timerD = timer2=null;
        var totalTimeD = ctmer =0;
         
         var flag=false;
         function converttime(secend)
         {
            var sec_num = parseInt(secend, 10); 
            var hours   = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);
            return [hours,minutes,seconds];
         }
    function startPlaying()
    {
         
            
        timerD = window.setInterval(function() {
            totalTimeD =converttime(videoplayer.currentTime);
            if(videoplayer.readyState==4 && typeof Duration=='undefined')
            {
                Duration=converttime(videoplayer.duration);
            }
        }, 10);
       
            timer2 = window.setInterval(function() {
            if(typeof Duration!='undefined')
            if(totalTimeD[0]== Duration[0] && parseInt(totalTimeD[1])>= parseInt(Duration[1])-3)
            {
                 clearInterval(timer2);
                 if(ctmer==0)
                 {
                    ctmer=1;
                    axios.post("{{route('gold.chall.unlock')}}",{cid:{{$mychall['Id']}}})
                    .then(function ({data}) {
                            if(data.status)
                            {
                                flag=true;
                                clearInterval(timerD);
                            }
                            
                        })
                        .catch(error => {
                            ctmer=0;
                        });
                }
            }            
           
        }, 10);
    }
</script>
<script>
    played=false;
    $(document).ready(function()
    {
      if(document.querySelector('.videoRes'))
      {
          $('.playicon').click(function ()
            {
              var videoRes=this.parentElement.querySelector('.videoRes');
              
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
              }
            });
          
          document.querySelectorAll('.videoRes').forEach((itm)=>{
            itm.addEventListener("pause", function(){
                 $('.playicon').show();
                itm.classList.add('blurEffect');
                itm.removeAttribute("controls");
              });
            itm.addEventListener("ended", function(){
              itm.addClass('blurEffect');
                  itm.removeAttribute("controls");
                $('.playicon').show();
              });
              itm.addEventListener("play", function(){
                itm.setAttribute("controls", "controls");
                itm.classList.remove('blurEffect');
                $('.playicon').hide();
                if(!played)
              {
                played=true;
                if (itm.requestFullscreen)
                    itm.requestFullscreen();
                else if (itm.mozRequestFullScreen)
                itm.mozRequestFullScreen();
                else if (itm.webkitRequestFullscreen)
                itm.webkitRequestFullscreen();
              }

              });
          });
      
      }
});
  function playpause()
  {
    progressUpdate=0;
   document.querySelectorAll('.videoRes').forEach((itm)=>{
      itm.pause();
    });  
  }
</script>
@endsection