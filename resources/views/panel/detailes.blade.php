
@extends('layouts.app')
<style>


/* .container {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
} */
.btn-master {
    border: 1px solid #5c6096!important;
    border-radius: 5px!important;
    color: #686da7!important;
    padding: 5px!important;
    width: fit-content!important;
    font-size: 9pt!important;
    display: block!important;
    margin: 10px auto!important;
    margin-bottom: 0!important;
}
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
            overflow-y: auto;
            overflow-x: hidden;
            /* height: 94vh; */
           
        }
    .leftnav {
    border-radius: 0 10px 10px 0;
    display: grid;
    gap: 20px;
    color: #ccd0f4;
    background-color: #53588f;
    position: fixed;
    float: left;
    left: 0;
    top: 73%;
    width: fit-content;
    padding: 10px;
    justify-content: center;
    opacity: 0.7;
    font-size: 9pt;
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
    max-width: 23rem!important;
    /* max-width: 150%!important; */
    height: auto;
    position: relative;
    right: -83px;
    /* top: -118px; */
    /* max-width: 1009px; */
    rotate: 342deg;
}
.bodyChall
{
    position: relative;
    top: -103px;
}
.challFile{
    position: relative;
    top: -67px;
}
.text-title {
    /* position: relative;
    top: -103px; */
    opacity: 0.25;
    color: #aeb1d4;
    font-weight: 900;
    font-family:'PEYDA-BLACK';
    font-size: calc(2.5rem + 1.5vw);
}
.text-subtitle {
    /* position: relative;
    top: -103px; */
    color: #aeb1d4;
    font-size: calc(2rem + 1.5vw);
    padding-inline-start: 14px;
    text-shadow: 2px 3px 3px #323030ad;
}

.cardChall {
    width: 100%;
    background: linear-gradient(230deg, #20234c, #373c74);
    border-radius: 12px;
    /* padding: 5px 15px; */
    padding: 15px;
    /* width: 95%; */
    /* transform: translate(-40%, 0); */
    box-shadow: 0 0 5px -1px #2f346c;
    font-size: 8pt;
    /* height: 23vh; */
    overflow: auto;
    font-family: Peyda;
    line-height: 20px;
    text-align: justify;
}

.card-body {
    /* padding: 25px; */
    font-family: Peyda;
}

..card-body p {
  /* line-height: 1.5; */
    line-height: 20px;
}

.challVideo {
    width: 100%;
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
@media (min-width: 764px)
{
   .leftnav
    {
        left: 27%!important;
    } 
}

</style>
@section('content')   

    <div class="row">
      <div class="col-12 col-md-6 divEarth">
        @if(in_array($chall->Chall->Type??'text',['image','archive','audio']))
        <img src="{{asset('img/details/other.png')}}" class="earth" alt="">
        @else
        <img src="{{asset('img/details/'.($chall->Chall->Type??'text').'.png')}}" class="earth" alt="">
        @endif
        
      </div>
    </div>
    <div class="row bodyChall">
      <div class="col-12">
        <h1 class="text-right text-title">چالش</h1>
        <h2 class=" text-subtitle">{{$chall->Chall->Title}}</h2>
        @if($chall->Chall->Body)
        <div class="cardChall text-white">
          <div class="card-body">
            <p> {!!$chall->Chall->Body!!}</p>
              @php
                  $num=['first'=>'الف','second'=>'ب','third'=>'ج','forth'=>'د','fifth'=>'ه','sixth'=>'و'];
                  $answers=json_decode($chall->Chall->Options??'[]');
              @endphp
            @if($answers)
            <p class="row">
              @foreach ($answers as $index=>$opt)
                @if($index!='ans')
                <label for="" class="col-6 d-inline-flex gap-1">
                  <input type="radio" name="Answer" id="answer" @if($chall->َMyAnswer==("پاسخ این سوال  ".$opt." است")) checked  @endif @if($chall->Closed || $chall->Expired) disabled @endif value="{{$opt}}">
                  {{$num[$index].') '.$opt}}
                  </label> 
                @endif  
              @endforeach 
              <button onclick="setAnswer()" class="btn btn-master">ثبت پاسخ</button>
            </p>
            @endif  
                       
            
          </div>
        </div>
        @endif
      </div>
    </div>
    <div class="row ChallFile">
      <div class="col-12">
        @if($chall->Chall->Type=='movie')
        <video class="challImg embed-responsive-16by9 challVideo" controlsList="nodownload" controls >
          <source src="{{$chall->Chall->File}}" type="video/mp4">
        </video>
        @elseif($chall->Chall->Type=='audio')
        <audio class="embed-responsive-16by9 challVideo" controlsList="nodownload" controls src="{{$chall->Chall->File}}" >
        </audio>
        @elseif($chall->Chall->Type=='image')
        <div class="d-inline-block">
            <img class="img-fluid challImg" src="{{$chall->Chall->File}}" alt="Image" >
            <div class="overlay">
            <a href="{{$chall->Chall->File}}" target="_blank" download>
            <img src="{{asset('img/details/download.png')}}" alt="Image" class="img-fluid">
            </a>
            </div>
        </div>
        @elseif($chall->Chall->Type=='archive')
        <div class="d-inline-block">
            <img class="img-fluid challImg"  src="{{asset('img/login/pic.png')}}" alt="Image" >
            <div class="overlay">
            <a href="{{$chall->Chall->File}}"  target="_blank" download>
            <img src="{{asset('img/details/download.png')}}" alt="Image" class="img-fluid">
            </a>
            </div>
        </div>
        @endif
      </div>
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
    @section('script')
        <script>
          function setAnswer()
          {
            const Expired={{$chall->Expired}};
            const closed={{$chall->Chat->Closed??0}};
            var useranswer=document.querySelector('input[type=radio]:checked');              

            if(Expired || closed)
            Swal.fire({
                icon: 'error',
                title: 'توجه',                
                confirmButtonText: 'بله',
                text:"{{auth()->user()->FullName}} \n زمان ارسال پاسخ این چالش گذشته "
            });
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
                        Swal.fire({
                                  icon: 'success',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
                              });
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
                                  //text:"{{auth()->user()->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                  html:"مشکل پیش آمده دوباره تلاش کن<p><small> <br>  "+error.stack+"</small></p>",

                              });
                  });
                }
              else
              {
                Swal.fire({
                icon: 'error',
                title: 'توجه',                
                confirmButtonText: 'بله',
                text:"{{auth()->user()->FullName}} \n یه گزینه انتخاب کن "
                 });
              }
            }
              
          }
        </script>
    @endsection