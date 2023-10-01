@extends('layouts.app')
@section('style')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        input[type="number"] {
        -moz-appearance: textfield;
        }

        .btn-img_1
        {
            /* background-image: url("{{asset('img/login/btn.png')}}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed; */
            
                background: linear-gradient(to left,#E91E63,#db2e6b, #f15fa5);
                border-radius: 15px;
                box-shadow: 0px 0px 7px 1px #f0599f;
                width: 75%;
                padding: 10px;
                color: #fff!important;
                border: none;
                box-sizing: content-box;
                justify-content: center;

        }
        .btn-img
        {
            background: linear-gradient(to left,#ff2385,#ff54ac);
            border-radius: 50px;
            box-shadow: 0px 0px 10px 1px #fd4ea0;
            width: 50%;
            padding: 12px;
            color: #fff!important;
            border: none;
            box-sizing: content-box;
            font-weight: 900;
            font-size: 12pt;
        }
        #FullHeight {
            background-image: url("{{asset('img/login/mask.png')}}");
            background-attachment: fixed;
            background-size: contain;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 88vh; */
        }
        .login 
        {
            /*padding: 10px 0 10px 0;
            border-radius: 0 0 20px 20px;
            background-color:#565b8d73;
            height:calc(100vh - 3%);*/
            
                background-image: url("{{asset('img/login/over.png')}}");
                background-attachment: fixed;
                background-size: cover;
                /* background-repeat: repeat-y; */
                background-repeat: no-repeat;
                background-position: center;
                /* padding: 10px;*/
                height: 90vh; 
                margin: 0 2px;
                border-radius: 0 0 16px 16px;
            
        }
        .txticon
        {
            border-radius: 0px 14px 14px 0px;
            box-shadow: -3px 3px 4px -2px #ffffff57;
            justify-content: center;
            align-items: center;
            /* border:2px solid red; */
        }
       .txt 
        {
            display: block;
            padding: 11px;
            border: none!important;
            border-color: #fff;
            /* background-color: transparent!important; */
            background: #2F3068!important;           
            box-shadow: -3px 3px 4px -2px #ffffff57;
            border-radius: 14px 0px 0px 14px;
            color: #fff!important;            
            font-size: 9pt;
        }
        .txt::placeholder
        {
            color: #cfcfcf!important;
            /* font-size: 8pt; */
             font-weight: 800;
             font-family: 'PEYDA-EXTRABOLD','Peyda',system-ui!important;
        }
        #Phone
        {
            font-weight: bold;
            font-family: 'Vazir','PEYDA-EXTRABOLD','Peyda',system-ui!important
        }
        .txt:focus-visible
        {
            background: #2F3068!important;
            outline:none!important;
        }
        .txt:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #2F3068 inset; 
            -webkit-text-fill-color:#fff;
            }
            @media (max-width: 420px)
            {
                .txt
                 {
                    padding: 0px!important;
                    height:51px;
                }
                #pic2
                 {
                    width: 100%;
                    height:38vh;
                    padding-top:10%;
                }
                
            }
            @media (min-width: 768px)
            {
                #pic2
                 {
                    /* height: 40vh; */
                    width: 20vw;
                }
                
            }
    </style>
@endsection
@section('content')  
<div class="login">

<div id="FullHeight">
    <div class="" id="loginDIV">
     
        {{-- <div class="text-center col-12 mt-5">
            <img src="{{asset('img/login/pic.png')}}" class="col-11" style="height:39vh;"> 
            <p class="text-light bold mt-2">
                چالش فرست کلاس
            </p>
        </div> --}}
        <div class="col-10 m-auto">
            <div class="pt-5 text-center">
                <img id="pic2" src="{{asset('img/login/pic2.png')}}" class="col-9 col-sm-auto" style=""> 
                <p class="bold h1 mt-3 mb-4 text-light" style="font-size: 16pt">
                    چالش فرست کلاس
                </p>
            </div class="">
                <form method="POST" action="{{ route('login') }}" id="frm">
                    @csrf

                    <div class="form-group mt-3 row m-auto">
                         <span class="bg-2F3068 col-2 d-flex text-center txticon">
                            <img src="{{asset('img/login/phone.png')}}" style="width: 15px"></i>
                        </span>
                        <input id="Phone" type="number" placeholder="شماره همراه" class=" col txt  @error('Phone') is-invalid @enderror" name="Phone" value="{{ old('Phone') }}" required autocomplete="Phone" autofocus>
                           
                    </div>
                    <div class="form-group mt-3 row m-auto">
                         <span class="bg-2F3068 col-2 d-flex text-center txticon">
                            <img src="{{asset('img/login/lock.png')}}" style="width: 15px"></i>
                        </span>
                        <input id="password" placeholder="رمز عبور" type="password" class="col txt  @error("Pass") is-invalid @enderror" name="Pass" required autocomplete="current-password">
                           
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-12">
                            <a class="btn mt-1 text-light pull-left" style="font-size:8pt;" onclick="forget()">
                                <i class="fa fa-redo-alt  mx-1" ></i>
                                فراموشی رمز عبور
                            </a>
                        </div>
                        <div class="col-12 text-center mt-4">
                            
                            <a type="submit" class="btn btn-img" onclick="login()">
                                ورود به برنامه
                            </a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
 
</div>   
@endsection
@section('script')
<script>
    window.addEventListener('resize', function() {
    /*var div1 = document.getElementById('FullHeight');
    const div2 = document.getElementById("loginDIV");
    div1.style.height = window.innerHeight + 'px';
    div2.style.height = `calc( ${div1.offsetHeight}px-20% )`;*/
    });
</script>
 <script>
var myTimeout;
document.addEventListener("keypress", function(event) {
  if (event.key === "Enter") 
     login();
});
  
 function checkInput() {
     if (!Phone.value) {
       Swal.fire({
        title:" کاربر گرامی",
        text:"لطفا شماره موبایل خود را وارد کنید", 
        confirmButtonText: 'بله',
        icon: "info"
        });
       return false
     }
     else
     return true;
   }
  function forget() {
     if (checkInput()) {
      Swal.fire({
          title:"لطفا منتظر بمانید...",
          html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
          icon:'info',
          allowOutsideClick:false,
          showConfirmButton:false,
        });
        var bodyFormData = new FormData()
        bodyFormData.append('Phone',Phone.value );
      
       axios({
         method: 'POST',
         url: "{{route('login.forget')}}",
         data: bodyFormData,
         headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
         }
       })
         .then((response) => {
          if (response.data.status == "200") 
          {
             
              Swal.fire({
                title:" کاربر گرامی",
                text:"رمزعبور برای شما ارسال شد", 
                confirmButtonText: 'بله',
                icon: "success"
                });             
           } 
           else 
           {
               Swal.close();
                Swal.fire({
                  title:"کاربر گرامی",
                  text:response.data.message, 
                  confirmButtonText: 'بله',
                  icon: "error"
                  });
           }
         })
         ['catch'](function (error) {
           console.log(error);
           Swal.close();
            Swal.fire({
              title:" کاربر گرامی",
              html:"مشکلی پیش آمده است لطفا مجددا تلاش کنید<p><small> <br>  "+error.stack+"</small></p>",
              confirmButtonText: 'بله',
              icon: "error"
              });
         })
     }
   }
   function login() {

     if (checkInput()) {
       if (!password.value) {
	    Swal.fire({
		title:" کاربر گرامی",
		text:"لطفا رمزعبور خود را وارد کنید", 
		confirmButtonText: 'بله',
		icon: "info"
		});
         return false
       } 
       else 
       {
        Swal.fire({
          title:"لطفا منتظر بمانید...",
          html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
          icon:'info',
          allowOutsideClick:false,
          showConfirmButton:false,
        });
         frm.submit();
       }
     }
   }
  
  
</script>   
@endsection