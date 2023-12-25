<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">
        <title>چالش فرست کلاس</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('css/font.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
        <link rel="stylesheet" href="{{ asset('fontawesome-6.4.2/css/all.css') }}">
		<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-minimal@4/minimal.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            .menu2 nav
            {
                background-color: #f3f3f3;
                width: 100%;
                border-radius: 19px;
                height: 60px;
                box-shadow: 0px 2px 6px -2px #000;
            }
            .menu2 .fa {
                font-size: 12pt;
            }
		.menu2 a {
            color: #393939;
            padding: 12px;
                font-size: 7pt;
        }
		.menu2 li {
                display: grid;
                justify-items: center;
                gap: 5px;
            }
            .menu2 a.active {
            border-radius: 50px;
            border: 1px solid transparent;
            background: #f3f3f3;
            bottom: 33px;
            position: relative;
            width: 65px;
            height: 65px;
            display: grid;
            align-items: center;
            box-shadow: 0px 2px 7px -3px #000;
        }
            .mobile-hide,.mobile-show
            {
                display: none;
            }
            @media (max-width:519px)
            {
                
                .mobile-show
                {
                    display: initial!important;
                }
            }
            @media (min-width:520px)
            {
                
                .mobile-hide
                {
                    display: initial!important;
                }
            }
            .navicon {
                margin-top: 11px;
                background-color: #4c4c4c;
                color: #b59f64;
                fill: #b59f64;
                border: 3px solid #060606;
                border-radius: 50px;
                width: 40px;
                height: 40px;
                font-weight: 500;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 21px;
                box-shadow: 3px 3px 10px -2px #000000e0;
            }
            nav a
            {
                text-decoration:none
            }
            .navimg {
                width: 70px;
            }
            #home .navimg {
                width: 64px!important;
            }
            #home {
                margin-top: 4px;
            }
            .dotnotif {
                position: absolute;
                /* right: 30px;
                top: -14px; */
                right: 0px;
                top: 17px;
                color: #10df39;
                font-size: 8pt;
                animation-name: notification;
                animation-duration: 1s;
                animation-iteration-count: infinite;
            }
            .menu2 {
                /* background-color: #f5f5f5;
                border-radius: 50px;
                color: #000;
                justify-content: center;
                padding: 10px;
                gap: 45px;
                text-align: center;
                box-shadow: 0px 4px 11px -4px #b5b5b5;
                position: fixed;
                width: calc(46vw - 10vw);
                bottom: 15px;
                right: calc(46vw - 15vw);
                z-index: 2; */
                position: fixed;
                width: calc(46vw - 10vw);
                bottom: -5px;
                right: calc(46vw - 15vw);
                z-index: 2;
            }
            .trophy_Active {
                background-color: #ececec;
                border-radius: 50px;
                box-shadow: 0px 4px 11px -4px #5c5c5c;
                position: fixed;
                bottom: 51px;
                width: 50px;
                outline: 4px solid #ececec;
                z-index: 2;
                font-size: 12pt;
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                right: 44vw;
                z-index: 3;
            }
            .trophy_Active i{
                display: flex;color: #636363;
                justify-content: center;
                align-items: center;
            }
            .history_Active {
                background-color: #ececec;
                border-radius: 50px;
                box-shadow: 0px 4px 11px -4px #5c5c5c;
                position: fixed;
                bottom: 51px;
                width: 50px;
                outline: 4px solid #ececec;
                z-index: 2;
                font-size: 12pt;
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                /* right: 19vw; */
                right: 12vh;
                z-index: 3;
            }
            .history_Active i{
                display: flex;
                color: #636363;
                justify-content: center;
                align-items: center;
            }
            /* .commenting_Active {
                background-color: #444a7e;
                border-radius: 50px;/
                position: fixed;
                bottom: 51px;
                width: 50px;
                outline: 4px solid #3b407a;
                color: #fff;
                z-index: 2;
                font-size: 12pt;
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                right: 47vw!important;
            }
            .commenting_Active i{
                display: flex;
                justify-content: center;
                align-items: center;
            } */
            .Active
            {
                margin-top: auto;
                color: #000;
            }
            .swal2-popup
            {
            font-size: 10pt!important;
            }
            .content2
            {
                overflow-y: auto;
                /* height: 58vh; */
                height: 78vh;
                padding: 12px;
            }
            dialog {
                width: 400px;
                height: 200px;
                background-color: #fff;
                border: 2px solid #3b407a;
                border-radius: 15px;
                padding: 20px;
                box-sizing: border-box;
                position: absolute;
                top: 15%;
            }
           @media (min-width: 764px)
            { 
                .menu2 img
                {
                    height: 97.835px;
                }               
                body
                {
                /* width: 51%; */
                width: 46vw;
                margin: 0 auto;
                }
                #loader,#content
                {
                width: 51%;
                }
                .swal2-popup
                {
                font-size: 10pt!important;
                }
                .trophy_Active
                {
                     right: 47.5vw!important;
                } 
                .history_Active
                {
                     right: 47.5vw!important;
                } 
                
            }
           @media (min-width: 420px)
            {
                #FullHeight,#content {
                /* background-repeat: repeat!important; */
                height: 97vh!important;
                }
                dialog
                {
                    width: 400px!important;
                }
                
            }
           @media (max-width: 760px)
            {
                .menu2
                {
                    width: 92vw!important;
                    right: 12px!important;
                }
                nav
                {
                    margin-top:5% ;
                    /* margin-right: -15px;
                    margin-left: 10px; */
                }
                dialog
                {
                    width: 95%!important;
                }
            }
            .menu2
                {
                    font-size: 9pt;
                }
            div#title 
            {
            /* font-size: 16pt; */
            /* margin-bottom: 0px !important;
            margin-top: -15px !important; */
            position: relative;
            top:7px;
            }
        </style> 
        <style>
            @keyframes notification {
            from {text-shadow: 0px 0px 0px }
            to {text-shadow: 0px 0px 7px }
            }
        </style>  
        
        <style>
            #loader
            {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* width: 86px; */
                height: 94px;
                margin: 0 auto;
                position: relative;
                flex-direction: column;
                gap: 16px;
                color: #5c5c5c;
                place-items: center;
            }
            .scene {
            position: relative;
            z-index: 2;
            height: 220px;
            width: 220px;
            display: grid;
            place-items: center;
            }

            .cube-wrapper {
            transform-style: preserve-3d;
            animation: bouncing 2s infinite;
            }

            .cube {
            transform-style: preserve-3d;
            transform: rotateX(45deg) rotateZ(45deg);
            animation: rotation 2s infinite;
            }

            .cube-faces {
            transform-style: preserve-3d;
            height: 80px;
            width: 80px;
            position: relative;
            transform-origin: 0 0;
            transform: translateX(0) translateY(0) translateZ(-40px);
            }

            .cube-face {
            position: absolute;
            inset: 0;
            background: #110d31ff;
            border: solid 1px #fff;
            }
            .cube-face.shadow {
            transform: translateZ(-80px);
            animation: bouncing-shadow 2s infinite;
            }
            .cube-face.top {
            transform: translateZ(80px);
            }
            .cube-face.front {
            transform-origin: 0 50%;
            transform: rotateY(-90deg);
            }
            .cube-face.back {
            transform-origin: 0 50%;
            transform: rotateY(-90deg) translateZ(-80px);
            }
            .cube-face.right {
            transform-origin: 50% 0;
            transform: rotateX(-90deg) translateY(-80px);
            }
            .cube-face.left {
            transform-origin: 50% 0;
            transform: rotateX(-90deg) translateY(-80px) translateZ(80px);
            }

            @keyframes rotation {
            0% {
                transform: rotateX(45deg) rotateY(0) rotateZ(45deg);
                animation-timing-function: cubic-bezier(0.17, 0.84, 0.44, 1);
            }
            50% {
                transform: rotateX(45deg) rotateY(0) rotateZ(225deg);
                animation-timing-function: cubic-bezier(0.76, 0.05, 0.86, 0.06);
            }
            100% {
                transform: rotateX(45deg) rotateY(0) rotateZ(405deg);
                animation-timing-function: cubic-bezier(0.17, 0.84, 0.44, 1);
            }
            }
            @keyframes bouncing {
            0% {
                transform: translateY(-40px);
                animation-timing-function: cubic-bezier(0.76, 0.05, 0.86, 0.06);
            }
            45% {
                transform: translateY(40px);
                animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
            }
            100% {
                transform: translateY(-40px);
                animation-timing-function: cubic-bezier(0.76, 0.05, 0.86, 0.06);
            }
            }
            @keyframes bouncing-shadow {
            0% {
                transform: translateZ(-80px) scale(1.3);
                animation-timing-function: cubic-bezier(0.76, 0.05, 0.86, 0.06);
                opacity: 0.05;
            }
            45% {
                transform: translateZ(0);
                animation-timing-function: cubic-bezier(0.23, 1, 0.32, 1);
                opacity: 0.3;
            }
            100% {
                transform: translateZ(-80px) scale(1.3);
                animation-timing-function: cubic-bezier(0.76, 0.05, 0.86, 0.06);
                opacity: 0.05;
            }
            }
        </style>     
        @yield('style')
    </head>
    <body class="antialiased overflow-x-hidden" onload="loding() ">
        <div class="container-fluid d-none"  id="content" >
        
            @if(session('User'))
                        
                @include('layouts.menu')
            
            @endif
            <div class="d-grid justify-content-center w-100" id="title">
                <h6 class=" bold text-center" style="font-size: 16pt;" >@yield('title')</h6> 
                @yield('subtitle')
            </div>
                @yield('content')
        </div>

        {{-- <div id="loader" class="container-fluid text-center" style="position: absolute;top: 45%;" >
                <div class="loader">
                <div></div>
                <div></div>
                <div></div>
                </div>
         </div> --}}
         <div id="loader">
            <div class="scene">
                <div class="cube-wrapper">
                  <div class="cube">
                    <div class="cube-faces">
                      <div class="cube-face shadow"></div>
                      <div class="cube-face bottom"></div>
                      <div class="cube-face top"></div>
                      <div class="cube-face left"></div>
                      <div class="cube-face right"></div>
                      <div class="cube-face back"></div>
                      <div class="cube-face front"></div>
                    </div>
                  </div>
                </div>
              </div>
            @if(session('User'))
            <b>منتظر بمون تا صفحه کامل بارگیری بشه</b>
            @else
            <b>لطفا صبر کنید ...</b>
            @endif
         </div>
        
        <audio src="{{asset('sound/notification.mp3') }}" id="notifaudio" style="display: none"></audio>
         
        {{-- </div> --}}
    </body>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.ably.com/lib/ably.min-1.js"></script>
    
    <script>
        @if(session('User'))
        function logout()
        {
            Swal.fire({
                title: 'خروج از برنامه',
                text: "{{session('User')->FullName}}  می خوای خارج بشی؟",//"آیا از خروج از حساب کاربری خود اطمینان دارید؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'نه',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios({
                    method: "POST",
                    url: "{{route('logout')}}"
                    })
                    .then((response) => {
                        window.location.href='{{route('home')}}';
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            });
        }
        function showWallet()
        {
            Swal.fire({
                title:"صبر کن ...",
                html:'<i class="fa fa-spinner fa-pulse" style="font-size: 12pt;"></i>',
                icon:'info',
                allowOutsideClick:false,
                showConfirmButton:false,
              });
                axios.post('{{route("user.wallet")}}')
                  .then(response => { 
                    if(response.data.success)
                        Swal.fire({
                                  icon: 'success',                      
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
           function loding () {
            @if(session('User'))
                        @if(session('Notifs'))
                        notif.classList.remove('d-none');
                        @else
                        notif.classList.add('d-none');
                        @endif
                    @endif
                   loader.remove();
                    content.classList.remove('d-none');
                    
                    @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'توجه',
                        confirmButtonText: 'بله',
                        text:"{{session('User')->FullName}} \n {{session('error')}}"
                    });
                    @endif
                    @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'عملیات موفقیت آمیز',
                        confirmButtonText: 'بله',
                        text:"{{session('User')->FullName}} \n {{session('success')}}"
                    });
                    @elseif($errors->any())
                    Swal.fire({
                                icon: 'error',
                                title: 'خطا',
								confirmButtonText: 'بله',
                                text:"<?php foreach ($errors->all() as $error) echo $error;?>"
                            });
                    @endif
            }
    
    </script>  
     @if(session('User'))
    <script>
        const userid='{{session("User")->Id}}';
        if(typeof Notification !== "undefined")
        {
        var perm=Notification.permission;
        if(perm=='default' || perm=='denied')
        {
            Notification.requestPermission().then(function (permission) {

            perm=permission;

            });
        }
    }
    else
    perm='denied';
        const icon="{{ asset('img/Logored.png') }}";
        const ably = new Ably.Realtime.Promise('{{env('ABLY_KEY')}}');
          ably.connection.once('connected');
        /* Rsive Chall Channel*/
          var channel = ably.channels.get('Challenge_Set.'+userid);
          channel.subscribe('ChallengeSet', function(data)
           {
              @if(\Route::currentRouteName()=="home") 
              showchall(JSON.parse(data.data));  
              @elseif(\Route::currentRouteName()=="notif.index") 
                axios.post('{{route("notif.reg")}}',{data:data.data});  
              shownotifList(JSON.parse(data.data));  
              @else
                axios.post('{{route("notif.reg")}}',{data:data.data});  
                shownotif(JSON.parse(data.data));    
              @endif
                         
              
          });
          
          /*Rsive Message Channel*/
          var channel = ably.channels.get('Challenge-Chat-Resive.'+userid);
          channel.subscribe('ChatResive', function(data) {   
              var d=JSON.parse(data.data);
              @if(\Route::currentRouteName()=="notif.index") 
                axios.post('{{route("notif.reg")}}',{data:data.data});  
              shownotifList(JSON.parse(data.data)); 
              @else
                if({{(\Route::currentRouteName()!="chat.index")?1:0}} || ({{(\Route::currentRouteName()=="chat.index")?1:0 }} && {{$chall->Id??0}}!=d.ChatId))  
                {  
                shownotif(JSON.parse(data.data));    
                axios.post('{{route("notif.reg")}}',{data:data.data});                      
                }
              @endif
              
          });
      
         function shownotif(data)
         {
            notif.classList.remove('d-none');
              document.getElementById('notifaudio').play();
            if(perm=='granted')  
            {
                body=data.Body.replaceAll('<br>','\n');
                body=body.replaceAll('/<br>/gi','\n\t');
                var notification = new Notification('چالش فرست کلاس', { body, icon });
                notification.onclick = () => {
                    notification.close();
                    axios.post('{{route("notif.seen")}}',{data:data});
                    if(data.url=='chall')
                    {
                     window.location.href='{{route("home")}}';
                    }
                    else
                    { 
                        window.location.href='{{route("home")}}/chat/'+data.ChatId;
                    }
                }
            }             
               
         }
         function showchall(data)
         {
            axios.post('{{route("chall.get")}}').then(function ({data}) {
                if (data.success)
                    content2.innerHTML=data.data;
                else 
                {

                }
            })
            .catch(error => {
                console.log('Report NewChall Error')
            });     
                
         }
         function shownotifList(data)
         {
            axios.post('{{route("notif.ajax")}}').then(function ({data}) {
                if (data.success)
                    content2.innerHTML=data.data;
                else 
                {

                }
            })
            .catch(error => {
                console.log('Report NewNotif Error')
            });     
                
         }
      </script>
     @endif
    @yield('script')
</html>
