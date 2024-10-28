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
            background: linear-gradient(to left, #00a73b, #00a73b);
            border: 1px solid #fff;
            border-radius: 15px;
            color: #fff;
            padding: 7px;
            width: 28%;
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
          @media (max-width: 488px)
            {
                .hmobile
                {
                height: 62vh;
                }
            }
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
            .hdesktop
                {
                    height: 63.5vh;
                    margin-bottom: 6px;
                }
            #content
            {
                background-size: 101px!important;
                background-attachment:scroll!important;
                width: 100%;
            }
            #content2
            {
                height: 93% !important;
            }

                        
            ::-webkit-scrollbar {  
                width: 5px; /* Width of the scrollbar */  
            }  

            ::-webkit-scrollbar-track {  
                background: transparent; /* Background of the scrollbar track */  
            }  

            ::-webkit-scrollbar-thumb {  
                background: #bebebe; /* Color of the scrollbar thumb */  
                border-radius: 10px; /* Rounded corners for the thumb */  
            }  

            ::-webkit-scrollbar-thumb:hover {  
                background: #9e9e9e; /* Color of the thumb on hover */  
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
{{route('gold.header',$app['AppId'])}}
@endsection
@section('content')  

<div id="content2" class="content2 " >   
    <div class="title col-md-12 mb-2 h-auto m-auto pt-3 py-2 rounded-4 text-center" style="background-color: #ffffff8c;border: 4px double #75757533;">
        سرفصلی که انتخاب کردی دارای چندین موضوع است. موضوع موردعلاقه خودت رو رزرو کن
        
    </div>           
    <div class="py-2 col-md-9 h-auto justify-content-center m-auto pt-3 rounded-4 row shadow" style="background-color: #ffffff8c;border: 1px solid #75757533;">
        
     @if($subjects->count())
        <div class="hmobile hdesktop overflow-y-auto">
            @foreach ($subjects as $castle) 
            <div class="col-12 mt-2 p-md-3  "  >
                <div class="align-items-center card-body d-flex gap-2 @if(!$loop->last)border-bottom @endif"  style="/*height: 6rem;*/">
                    <input type="radio" name="mysubject" value="{{$castle['Id']}}">
                    <label class="title">                      
                    
                        @php
                        $stringCut = substr(strtr($castle['Title'],["\n"=>' ']), 0, 500);
                        $endPoint = strrpos($stringCut, ' ');
                        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $string .= '...';
                        @endphp     
                        @if(0 && strlen($castle['Title'])>100) 
                        <p class="mx-3" id="limitsubj{{$castle['Id']}}">
                            {!!$string!!} <a class="c-pointer pull-left btn-link" onclick="limitsubj{{$castle['Id']}}.classList.add('d-none');allsubj{{$castle['Id']}}.classList.remove('d-none')">بیشتر</a>
                        </p>
                        <p class="mx-3 d-none" id="allsubj{{$castle['Id']}}">
                            {!!$castle['Title']!!}
                        </p>
                        @else
                        <p class="mx-3" id="allsubj{{$castle['Id']}}">
                            {{$castle['Title']}}
                        </p>
                        @endif
                    </label>   
                </div>  
            </div>
            @endforeach
        </div>
        <span class="c-pointer text-center btn-master " onclick="reservation(this)">
            رزرو کنید
        </span>
    @else
    <div>
        <p class="noinfo text-center">اطلاعاتی یافت نشد</p>
    </div>
    @endif

    </div>
</div>
      
@endsection
@section('script')  
<script>
    @if($mysubject->Count() && $user->Perm==3)
    $('document').ready(function(){
    document.querySelectorAll('input[name=mysubject]').forEach(elm => {
        elm.disabled=true;
    });
    document.querySelector('.btn-master').disabled=true;
    document.querySelector('.btn-master').classList.add('d-none');

    });
    @endif
function reservation(obj)
{
    obj.disabled=true;
    document.querySelectorAll('input[name=mysubject]').forEach(elm => {
        elm.disabled=true;
    });
    Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
              var subj=document.querySelector('input[name=mysubject]:checked');
              if(!subj)
              {
                Swal.fire({
                        icon: 'error',
                        title: 'خطا',                        
                        confirmButtonText: 'بله',
                        //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                        html:"{{session('User')->FullName}} \n اول یه موضوع انتخاب کن",

                    });
                    document.querySelectorAll('input[name=mysubject]').forEach(elm => {
                            elm.disabled=false;
                        });
                     obj.disabled=false;
                    return false;
              }
                axios.post('{{route("gold.subject.select")}}',{subject:subj.value})
                  .then(response => { 
                    if(response.data.success)
                        Swal.fire({
                                  icon: 'success',                      
                                  confirmButtonText: 'بله',
                                  html:response.data.msg,
                              }).then((result) => {
                                if (result.isConfirmed)
                                {
                                    location.href='{{route("gold.chall")}}';
                                }
                                
                            });
                              
                    })
                  .catch(error => {
                      console.log(error);
                      document.querySelectorAll('input[name=mysubject]').forEach(elm => {
                            elm.disabled=false;
                        });
                     obj.disabled=false;

                      Swal.fire({
                                  icon: 'error',
                                  title: 'خطا',                        
                                  confirmButtonText: 'بله',
                                  //text:"{{session('User')->FullName}} \n مشکلی پیش آمده مجدد تلاش کن"
                                  html:"مشکل پیش آمده دوباره تلاش کن",

                              });
                  });
}
</script>   
@endsection