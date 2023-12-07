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
        .btn-img
        {
            background:linear-gradient(to bottom,#FFE5AB,#8E7A4A);/* linear-gradient(to bottom,#f4daa0,#998553);*/
            border-radius: 50px;
            box-shadow: 0px -3px 10px -2px #9e9e9e7a;
            width: 150px;
            padding:10px;
            color: white!important;
            border: none;
            box-sizing: content-box;
            font-weight: 900;
            font-size: 12pt;
        }
        .login 
        {
                height: 90vh; 
                /* margin: 0 12px;
                border-radius: 0 0 16px 16px; */
            
        }
        .txticon
        {
            border-radius: 0px 14px 14px 0px;
            box-shadow: inset 0px -1px 1px #ebebeb;
            /* box-shadow: -3px 3px 4px -2px #ccc; */
            justify-content: center;
            align-items: center;
            background: #f9f9f9;
            border: 1px solid #bababa59;
            border-left: 0;
            padding-left: 0px;
            padding-right: 5%;
        }
        .txtline
        {
            width: 1px;
            box-shadow: inset 0px -1px 1px #ebebeb;
            background: #f9f9f9;
            border: 1px solid #bababa59;
            border-left: 0;
            border-right: 0;
        }
        .txtline i
        {
            border-left: 1.5px solid #adadad;
        }
       .txt 
        {
            display: block;
            padding: 11px;
            border: 1px solid #bababa59;
            /* background-color: transparent!important; */
            background: #f9f9f9;
            box-shadow: inset 0px -1px 1px #ebebeb;
            /* box-shadow: -3px 3px 4px -2px #ccccccd9; */
            border-radius: 14px 0px 0px 14px;
            color: #adadad!important;
            font-size: 9pt;
            border-right: 0;
        }
        .txt::placeholder
        {
            color: #d8d8d8!important;
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
            background: #f9f9f9;
            outline:none!important;
        }
        .txt:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #f9f9f9 inset; 
            -webkit-text-fill-color:#adadad;
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
                    /* height:38vh;
                    padding-top:10%; */
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
        
            <div class="col-12 mt-3 p-3 d-flex justify-content-center ">
                <img id="" src="{{asset('img/login/pic2.png')}}" class="h-auto w-100" style=""> 
            </div>
            <div class="col-12 d-flex justify-content-center mx-2 ">
                <img id="" src="{{asset('img/login/title.png')}}" class="h-auto w-75" style=""> 
            </div>
            <div class="col-12 px-3 ">
                <form method="POST" action="{{ route('login') }}" id="frm">
                    @csrf

                    <div class="form-group mt-3 row m-auto">
                         <span class="col-2 d-flex text-center txticon">
                            <img src="{{asset('img/login/phone.png')}}" style="width: 15px">
                        </span>
                        <span class="d-flex py-2 text-center txtline">
                            <i></i>           
                        </span>
                        <input id="Phone" type="number" placeholder="شماره همراه" class=" col txt  @error('Phone') is-invalid @enderror" name="Phone" value="{{ old('Phone') }}" required autocomplete="Phone" autofocus>
                           
                    </div>
                    <div class="form-group mt-3 row m-auto">
                         <span class="col-2 d-flex text-center txticon">
                            <img src="{{asset('img/login/lock.png')}}" style="width: 15px"></i>
                        </span>
                        <span class="d-flex py-2 text-center txtline">
                            <i></i>           
                        </span>
                        <input id="password" placeholder="رمز عبور" type="password" class="col txt  @error("Pass") is-invalid @enderror" name="Pass" required autocomplete="current-password">
                           
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-12">
                            <a class="btn mt-1 text-5c5 pull-left" style="font-size:8pt;" onclick="forget()">
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