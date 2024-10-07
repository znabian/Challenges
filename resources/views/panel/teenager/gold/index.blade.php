@extends('layouts.app')
@section('style')
<style>
    .btngold {
        background: linear-gradient(180deg,#c4b071, #E9D491, #E9D491, #BCA96C);
        outline: 2px solid #C2BB78;
        border: 0;
        padding: 7px;
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
            margin-top: 10%;
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
            width: 15rem;
            height: 10rem;
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
            font-size: 9pt; 
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
            .topimg
            {
                width:13.13rem!important;
            }
        }
        .topimg
        {
            width:15rem;
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
            height:83vh!important;
        }
        .card-body
        {
            padding: 9px;
        }
.btnplay
 {
    background: linear-gradient(180deg, #dbc392, #d2b477);
    border: 5px solid;
    border-top-color: #4d4b4b;
    border-bottom-color: #000;
    border-left-color: #181818;
    border-right-color: #181818;
    padding: 1.25rem;
    font-size: 15pt;
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
    </style>
@endsection
@section('title')  
 چالش طلایی
@endsection
@section('content')  


<div id="content2" class="content2 " >             
    <div class="h-auto justify-content-center row w-100 m-auto gap-1">
        <div class="col-12 p-3 d-flex justify-content-center ">
            <img src="{{asset('img/login/pic2.png')}}" class="topimg h-auto "> 
        </div>
       <span class="bg-white col-md-8 mx-auto p-3 rounded-5 text-center" style="font-size: 10pt">{{session('User')->Name}} عزیز روی دکمه زیر بزن و با دقت گوش کن</span>
       <div class="col-12" style="margin-top: 3px;">
        <div class="c-pointer circle  m-auto btnplay" onclick="playAudio()" style="">
            <i class="fa fa-play " id="playericon1"></i>
        </div>
       </div>
        <div class="d-flex gap-2 m-0 py-1 col-md-6">
            <audio src="{{asset('sound/ringing.mp3')}}" id="player1" class="d-none"></audio>
            <div class="bg-light d-flex justify-content-center waveplayer">
            <div class="wave" id="wave1">
              <div class="played" id="played1"></div>
                <input type="range"  value="0" step="0.1" onchange="changeCurrentTime(this.value)" id="progress1" class="progress">                          
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
            <button class="btngold col-6 col-md-3 ltr mt-1 rounded-4 text-light c-pointer" onclick="nextbtn.classList.remove('fa-arrow-left-long');nextbtn.classList.add('fa-spinner'); location.href='{{route('gold.supervisor')}}';">
                <i class="fa fa-arrow-left-long mt-1 pull-left" id="nextbtn"></i>
                شروع
            </button>

          </div>

    </div>
</div>

         
@endsection
@section('script')
<script>
    function playAudio(id=1)
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
                      text:"{{session('User')->FullName}} \n  متاسفم فایلش پیدا نشد "

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
      function changeCurrentTime(value,id=1)
      {
        var sounds=document.getElementById('player'+id);

        sounds.pause();
        progressUpdate=0;
        sounds.currentTime=value
        sounds.play();
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
</script>
@endsection