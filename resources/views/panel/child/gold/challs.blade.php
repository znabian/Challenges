@extends('layouts.childApp')
@section('style')
<style>
    .videoplayer {

        margin-top: 4%;
        width: 100%;
        height: 233px;
        border-radius: 7px;
        /* box-shadow: 0px 6px 10px -5px #1a18188f; */
        object-fit: scale-down;
        background-color: #c50b08;
        padding: 0;
        }
    .btngold {
        background: linear-gradient(180deg,#c4b071, #E9D491, #E9D491, #BCA96C);
        outline: 2px solid #C2BB78;
        border: 0;
        padding: 7px;
    }
    .centerdiv
    {
        margin-top: 10% !important;
    }
        .card.active:hover
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
            border-radius: 15px;/*25*/
            border: unset;
            /* box-shadow: -5px 0px 9px -3px #d2d3e38f; */
            /* border: 1px solid #edc587; */
            color: #616161;
            /* padding: 10px; */
            font-weight: normal;
            font-family: 'PEYDA-BLACK';
            box-shadow: -3px 0px 7px -3px #c2c2c2, 5px 5px 10px -3px #c2c2c2;
            /* margin-bottom: 30px; */
            max-height: 170px;
            /* width: 45%; */
        }
        .card.active {
            cursor: pointer;
        }
        .card.disabled {
            background: #d3d2d073;
            cursor: not-allowed;
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
            width: 3rem;
            height: 3rem;
            margin: 0 15px;
        }
        .logoicon {
            width: 2rem;
            height: 2rem;
            margin: 0 5px;
        }
        .subtit
        {
            
            font-size: 8pt;
            font-family: 'Peyda';
            font-weight: 100;
            text-wrap: nowrap;

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
            .imgicon-md
            {
                margin-left: 4rem;
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
            height:67vh!important;
        }
        .card-body
        {
            padding: 9px;
        }
    </style>
@endsection
@section('title')  
 چالش طلایی
@endsection
@section('subtitle')  
@if(session('User')->Perm==3)
 <a class="subtit btn btn-link" href="{{route('gold.index')}}">مشاهده لیست موضوعات</a>
 @endif
@endsection
@section('content')  


<div id="content2" class="content2 " >    
    <div class="col-11 m-auto bg-body-secondary border border-3 row mt-0 noinfo p-2 rounded-4 shadow-none align-items-center">
         @php
         $subject['Subject']=trim(strtr($subject['Subject'],["\n"=>' ']));
            $stringCut = substr($subject['Subject'], 0, 100);
             $endPoint = strrpos($stringCut, ' ');
             $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
             $string .= '...';
         @endphp 
         <div class="col-9 d-grid">
         <small class="">موضوع:</small> 
                 
            @if(strlen($subject['Subject'])>100) 
            <span class="title" id="limitsubj">
                {{$string}} <a class="c-pointer btn-link" onclick="limitsubj.classList.add('d-none');allsubj.classList.remove('d-none')">بیشتر</a>
            </span>
            <span class="title d-none" id="allsubj">
                {{$subject['Subject']}}
            </span>
            @else
            <span class="title" >
                {{$subject['Subject']}}
            </span>
            @endif
         </div>
        <div class="col-3 d-grid text-center px-2 gap-1">
		@if(is_null($subject['Confirm']))
            <span class="bg-secondary subtit p-1 rounded text-light" >
            در انتظار تایید
            </span>
            @elseif($subject['Confirm']==1)
            <span class="bg-gradient  subtit p-1 rounded text-light bg-success" >
            تایید شده 
             </span>
            @if($subject['Page'])
            @php
            $page=last(explode('/',$subject['Page']));
            $page=(explode('?',$page))[0];
            $stringCut = substr($page, 0, 30);
             $endPoint = strrpos($stringCut, ' ');
             $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
             if(strlen($page)>30)
             $string .= '...';
            @endphp
                <span class="bg-2F3068 bg-gradient p-1 rounded subtit text-light">{{$string}}</span>
            @endif
             @elseif($subject['Confirm']==2)
             <span class=" subtit p-1 rounded text-light bg-danger" >
                 رد شده
             </span>
             @endif
		</div>
        @if(!$subject['Page'] && $subject['Confirm']==1)
            <div class="mt-2 align-items-center border-top col-12 d-flex justify-content-center p-2 title">
                
                    <label for="">نشانی پیج</label>
                    <input type="url" name="" id="mypage" class="border-0 col-7 mx-2 p-1 rounded">
                    <button class="btngold fa fa-check rounded-1 text-white" onclick=" setMyPage();"></button>
               
            </div>
        @endif
     </div>         
    <div class="gap-3 gap-md-4 h-auto justify-content-center row w-100 m-auto ">
        @if($subject['Confirm']==2)
        <div id="pNochall" class="p-4 d-grid text-right noinfo">
            <small class="text-center">موضوع انتخابیت به دلیل زیر رد شده:</small>
            <p class="subtitle mt-2" style="font-size:10pt;">
                {{$subject['Description']}}
            </p>
            
        </div>
        <div class="col-12 text-center">
            <button class="btngold col-6 col-md-3 ltr mt-1 rounded-4 text-light c-pointer" onclick="nextbtn.classList.remove('fa-arrow-left-long');nextbtn.classList.add('fa-spinner'); location.href='{{route('gold.reset')}}';">
                <i class="fa fa-arrow-left-long mt-1 pull-left" id="nextbtn"></i>
                شروع مجدد
            </button>

          </div>
        @else
        <div id="plist" class="gap-3 gap-md-4 h-auto justify-content-center row w-100 m-auto @if(!$subject['Platform']) centerdiv @endif ">
            <div id="ptit" class="text-center">
            <p class="px-md-5 subtit text-success " style="text-align: justify;text-wrap: pretty;">
                &bullet; پس از تایید موضوع، برای انجام دادن چالش طلایی خودت میتونی از اینستاگرام و یا از روبیکا استفاده کنی.
            </p>
            <span class="">  اپلیکیشن مورد نظرت رو انتخاب کن</span>
            </div>

            
            <div id="insta" class="@if($subject['Platform']) d-none @endif headerbtn card col-12 col-md-5 d-flex p-md-3 c-pointer" onclick="showitems('instagram',this)">
                <div class=" align-items-center card-body d-flex flex-row-reverse gap-1">
                    <span class="col-10 title text-center">
                        آموزش های اینستاگرام
                    </span>
                    <img src="{{asset('img/logo/insta.png')}}" class="logoicon" alt="اینستاگرام">

                        
                </div>  
            </div>
            <div id="rubika" class="@if($subject['Platform']) d-none @endif headerbtn card col-12 col-md-5 d-flex p-md-3 c-pointer" onclick="showitems('rubika',this)">
                <div class=" align-items-center card-body d-flex flex-row-reverse gap-1">
                    <span class="col-10 title text-center">
                        آموزش های روبیکا
                    </span>
                    <img src="{{asset('img/logo/rubika.png')}}" class="logoicon" alt="روبیکا">

                        
                </div>  
            </div>
            
            <div id="reselect" class="col-md-10 gap-1 justify-content-between mt-2 row @if(!$subject['Platform']) d-none @endif">
                <div class="bg-gradient bg-opacity-50 bg-primary c-pointer card col-md-5 col d-flex p-md-3 rounded-3" onclick="window.open('{{route('home')}}/uploads/Gold/template.zip');window.focus();">
                    <div class=" align-items-center card-body d-flex flex-row-reverse gap-1">
                        <span class="col-10 text-center title">دانلود قالب استوری و ریلز</span>
                        
                        <i class="bg-opacity-50 bg-primary-subtle fa fa-download p-1 rounded-circle"></i>
    
                            
                    </div>  
                </div>
                <div class="bg-gradient bg-opacity-50 bg-warning c-pointer card col-md-5 col d-flex p-md-3 rounded-3" onclick="reSelectPlatform(this)">
                    <div class=" align-items-center card-body d-flex flex-row-reverse gap-1">
                        <span class="col-10 text-center title">
                            انتخاب مجدد اپلیکیشن
                        </span>
                        
                        <i class="bg-opacity-50 bg-warning-subtle fa fa-undo p-1 rounded-circle"></i>
    
                            
                    </div>  
                </div>
            </div>
            @php
                $unlock['instagram']=1;
                $unlock['rubika']=1;
                if($subject['Platform'])
                $videos=$videos->where('Logo',$subject['Platform']);
                
            @endphp
            @foreach ($videos as $item) 
            <div class="{{$item['Logo']}} myVideos card col-12 col-md-10 d-none mt-1 p-md-3 @if($unlock[$item['Logo']]) active @else disabled @endif"  @if($unlock[$item['Logo']]) onclick="playvideo({{$item['Id']}})" @endif>
                <div class="align-items-center card-body d-flex flex-row-reverse gap-1">
                   <div class="col-10 d-grid">
                    <span class="title">
                        {{ $item['Title']}}
                    </span>
                    <span class="subtitle">
                        {{ $item['Body']}}
                    </span>
                   </div>
                   @if($unlock[$item['Logo']])
                   <img src="{{asset('img/playbtn.svg')}}" class="imgicon imgicon-md" alt="{{ $item['Title']}}">
                   @else
                   <img src="{{asset('img/lockbtn.png')}}" class="imgicon imgicon-md" alt="{{ $item['Title']}}">
                   @endif
                        
                </div>  
            </div>
            @php
                $unlock[$item['Logo']]=$item['unlock'];
            @endphp
            @endforeach            
            
        </div>

        @endif
    </div>
</div>

@include('layouts.menu4')          
@endsection
@section('script')
<script>
    var items={!!json_encode($videos)!!};
    var videoitem=0;
    
    @if($subject['Platform'] && $subject['Confirm']==1)
    showitems('{{$subject['Platform']}}',0);
    @endif
    function showitems(item=0,obj=0)
    {
        @if($subject['Confirm']==1)
            document.querySelectorAll('.myVideos').forEach(element => {
                    element.classList.add('d-none');
                });
            if(item)
            {
                
                document.querySelectorAll('.myVideos.'+item).forEach(element => {
                    element.classList.remove('d-none');
                    element.classList.add('d-flex');
                });

                document.querySelectorAll('.headerbtn').forEach(element => {
                    element.classList.add('d-none');
                });
                plist.classList.remove('centerdiv');
                ptit.classList.add('d-none');
                reselect.classList.remove('d-none');
                /*obj.classList.remove('col-5');
                obj.classList.add('col-12');
                obj.classList.remove('d-none');*/
                
            }
            else
            {
                document.querySelectorAll('.headerbtn').forEach(element => {
                    element.classList.remove('d-none');
                    //element.classList.remove('col-12');
                    //element.classList.add('col-5');
                });
                
                plist.classList.add('centerdiv');
                ptit.classList.remove('d-none');
                reselect.classList.add('d-none');
            }
        @else
            if(Swal)
            {
                Swal.fire({
                            icon: 'error',
                            title: 'دسترسی بسته شده',                        
                            confirmButtonText: 'بله',
                            //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                            html:"{{session('User')->Name}} عزیز <br> موضوع شما هنوز توسط استاد خوش نظر تایید نشده",

                        });
            }
            else
            alert("{{session('User')->Name}} عزیز \n موضوع شما هنوز توسط استاد خوش نظر تایید نشده");
        @endif
        

    }
    function playvideo(item=0)
    {
        
        @if($subject['Confirm']==1)
           location.href='{{route("home")}}/Gold/play/'+item
        @else
            if(Swal)
            {
                Swal.fire({
                            icon: 'error',
                            title: 'دسترسی بسته شده',                        
                            confirmButtonText: 'بله',
                            //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                            html:"{{session('User')->Name}} عزیز <br> موضوع شما هنوز توسط استاد خوش نظر تایید نشده",

                        });
            }
            else
            alert("{{session('User')->Name}} عزیز \n موضوع شما هنوز توسط استاد خوش نظر تایید نشده");
        @endif
        

    }
    function setMyPage()
    {
        
        @if($subject['Confirm']==1)   
        if(!mypage.value)
         mypage.focus();
        else   
        {

            Swal.fire({
                  title:"کمی صبر کن",
                  html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                  icon:'info',
                  allowOutsideClick:false,
                  showConfirmButton:false,
                });
          axios({
          method: 'POST',
          url:'{{route('gold.chall.setPage')}}',
          data:{sid:'{{$subject['Id']}}',Page:mypage.value},
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function ({data}) {
              if (data.status)
                {
                    location.reload();
                    return true;
              }
              else {
                  
                  Swal.fire('توجه',"اطلاعات ثبت نشد یکبار دیگه تلاش کن",'error');
                  return false;

              }
          })
          .catch(error => {
                Swal.fire('توجه',"اطلاعات ثبت نشد یکبار دیگه تلاش کن",'error');
                  return false;
          });
        }     
        
        @else
            if(Swal)
            {
                Swal.fire({
                            icon: 'error',
                            title: 'دسترسی بسته شده',                        
                            confirmButtonText: 'بله',
                            //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                            html:"{{session('User')->Name}} عزیز <br> موضوع شما هنوز توسط استاد خوش نظر تایید نشده",

                        });
            }
            else
            alert("{{session('User')->Name}} عزیز \n موضوع شما هنوز توسط استاد خوش نظر تایید نشده");
        @endif
        

    }
    function reSelectPlatform()
    {
        
        @if($subject['Confirm']==1)   
        @if(!$subject['Platform'])
        showitems(0,0);
        @else
            Swal.fire({
                  title:"کمی صبر کن",
                  html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                  icon:'info',
                  allowOutsideClick:false,
                  showConfirmButton:false,
                });
          axios({
          method: 'POST',
          url:'{{route('gold.chall.reset.platform')}}',
          data:{sid:'{{$subject['Id']}}'},
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(function ({data}) {
              if (data.status)
                {
                    location.reload();
                    return true;
              }
              else {
                  
                  Swal.fire('توجه',"اطلاعات ثبت نشد یکبار دیگه تلاش کن",'error');
                  return false;

              }
          })
          .catch(error => {
                Swal.fire('توجه',"اطلاعات ثبت نشد یکبار دیگه تلاش کن",'error');
                  return false;
          });  
        @endif
        @else
            if(Swal)
            {
                Swal.fire({
                            icon: 'error',
                            title: 'دسترسی بسته شده',                        
                            confirmButtonText: 'بله',
                            //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                            html:"{{session('User')->Name}} عزیز <br> موضوع شما هنوز توسط استاد خوش نظر تایید نشده",

                        });
            }
            else
            alert("{{session('User')->Name}} عزیز \n موضوع شما هنوز توسط استاد خوش نظر تایید نشده");
        @endif
        

    }
    
</script>
@endsection