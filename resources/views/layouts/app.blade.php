<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <title>چالش فرست کلاس</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('css/font.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
        <link rel="stylesheet" href="{{ asset('fontawesome-6.4.2/css/all.css') }}">
        <!-- Styles -->
        <style>
            .navimg {
                width: 70px;
            }
            .dotnotif {
                position: relative;
                right: 31px;
                top: -18px;
                color: #fb4f9c;
                font-size: 8pt;
                animation-name: notification;
                animation-duration: 1s;
                animation-iteration-count: infinite;
            }
            .menu2 {
                background-color: #444a7e;
                border-radius: 50px;
                color: #9a9ba5;
                justify-content: center;
                padding: 10px;
                gap: 45px;
                text-align: center;
                box-shadow: 0px 4px 11px -4px #363a6f;
                position: fixed;
                width: calc(46vw - 10vw);
                bottom: 15px;
                right: calc(46vw - 15vw);
            }
            .trophy_Active {
                background-color: #444a7e;
                border-radius: 50px;
                /* box-shadow: 0px 4px 11px -4px #363a6f; */
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
                right: 44vw;
            }
            .trophy_Active i{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .history_Active {
                background-color: #444a7e;
                border-radius: 50px;
                /* box-shadow: 0px 4px 11px -4px #363a6f; */
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
                /* right: 19vw; */
                right: 12vh;
            }
            .history_Active i{
                display: flex;
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
                color: #fff;
            }
            .swal2-popup
            {
            font-size: 10pt!important;
            }
            .content2
            {
                overflow-y: auto;
                height: 58vh;
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
                body
                {
                /* width: 51%; */
                width: 46vw;
                margin: 0 auto;
                }
                #loader
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
                background-repeat: repeat!important;
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
        </style> 
        <style>
            @keyframes notification {
            from {text-shadow: 0px 0px 0px }
            to {text-shadow: 0px 0px 7px }
            }
        </style>  
        <style>
            /*.loader{
                width: 86px;
                height: 94px;
                margin: 0 auto;
                position: relative;
            }
            .loader div{
                width: 18px;
                height: 18px;
                margin: 0 10px 0 0;
                border-radius: 50px;
                transform-origin: 50% 0;
                display: inline-block;
                animation: bounce 1s linear infinite;
            }
            .loader div:last-child{ margin: 0; }
            .loader div:nth-child(1){ background: #f42f25; }
            .loader div:nth-child(2){
                background: #f49725;
                animation-delay: 0.1s;
            }
            .loader div:nth-child(3){
                background: #255ff4;
                animation-delay: 0.2s;
            }
        @keyframes bounce{
            0%, 100%{
                transform: translateY(0) scale(1, 1);
                animation-timing-function: ease-in;
            }
            45%{
                transform: translateY(80px) scale(1, 1);
                animation-timing-function: linear;
            }
            50%{
                transform: translateY(80px) scale(1.5, 0.5);
                animation-timing-function: linear;
            }
            55%{
                transform: translateY(80px) scale(1, 1);
                animation-timing-function: ease-out;
            }
        }*/
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
                color: #fff;
            }
            .planet {
                display: block;
                width: 125px;
                height: 125px;
                position: relative;
                transform-style: preserve-3d;
                border-radius: 50%;
                background: #fcc96b;
                background: rgb(252, 201, 107);
                background: linear-gradient(
                    180deg,
                    rgba(252, 201, 107, 1) 0%,
                    rgba(252, 201, 107, 1) 15%,
                    rgba(247, 174, 1, 1) 15%,
                    rgba(247, 174, 1, 1) 19%,
                    rgba(252, 201, 107, 1) 19%,
                    rgba(252, 201, 107, 1) 22%,
                    rgba(247, 174, 1, 1) 22%,
                    rgba(247, 174, 1, 1) 28%,
                    rgba(252, 201, 107, 1) 28%,
                    rgba(252, 201, 107, 1) 31%,
                    rgba(252, 201, 107, 1) 33%,
                    rgba(252, 201, 107, 1) 36%,
                    rgba(247, 174, 1, 1) 36%,
                    rgba(247, 174, 1, 1) 48%,
                    rgba(252, 201, 107, 1) 48%,
                    rgba(252, 201, 107, 1) 55%,
                    rgba(247, 174, 1, 1) 55%,
                    rgba(247, 174, 1, 1) 66%,
                    rgba(252, 201, 107, 1) 66%,
                    rgba(252, 201, 107, 1) 70%,
                    rgba(247, 174, 1, 1) 70%,
                    rgba(247, 174, 1, 1) 73%,
                    rgba(252, 201, 107, 1) 73%,
                    rgba(252, 201, 107, 1) 82%,
                    rgba(247, 174, 1, 1) 82%,
                    rgba(247, 174, 1, 1) 86%,
                    rgba(252, 201, 107, 1) 86%
                );
            box-shadow: inset 0 0 25px rgba(0, 0, 0, 0.25),
                inset 8px -4px 6px rgba(199, 128, 0, 0.5),
                inset -8px 4px 8px rgba(255, 235, 199, 0.5),
                inset 20px -5px 12px #f7ae01,
                0 0 100px rgba(255, 255, 255, 0.35);
            transform: rotateZ(-15deg);
            
            }

            .planet::before {
            position: absolute;
            content: "";
            display: block;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            border: 16px solid #7b6f42;
            border-top-width: 0;
            border-radius: 50%;
            box-shadow: 0 -2px 0 #b1a693;
            /* animation: rings1 0.8s infinite linear; */
            animation: shine 1s infinite  alternate;
            transform: rotateX(65deg) rotateZ(0deg) scale(1.75);
            }

            .planet::after {
            position: absolute;
            content: "";
            display: block;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            border: 8px solid #b1a693;
            border-top-width: 0;
            border-radius: 50%;
            box-shadow: 0 -2px 0 #7b6f42;
            /* animation: rings2 0.8s infinite linear; */
            transform: rotateX(65deg) rotateZ(0deg) scale(1.7);
            }

            @keyframes rings1 {
            0% {
                transform: rotateX(65deg) rotateZ(0deg) scale(1.75);
            }
            100% {
               transform: rotateX(65deg) rotateZ(360deg) scale(1.75);
            }
            }

            @keyframes rings2 {
            0% {
                transform: rotateX(65deg) rotateZ(0deg) scale(1.7);
            }
            100% {
                transform: rotateX(65deg) rotateZ(360deg) scale(1.7);
            }
            }
            @keyframes shine {
            0% {
               box-shadow: 0 0 2px #fcc96b;
            }
            100% {
                box-shadow: 0 0 15px  #fcc96b;
            }
            }
        </style>     
        @yield('style')
    </head>
    <body class="antialiased overflow-hidden" onload="loding() ">
        <div class="container d-none"  id="content" >
        
            @if(Auth::check())
                        
                @include('layouts.menu')
            
            @endif
          
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
            <div class="planet"></div>
            @auth
            <b>منتظر بمون تا صفحه کامل بارگیری بشه</b>
            @else
            <b>لطفا صبر کنید ...</b>
            @endauth
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
        @auth
        function logout()
        {
            Swal.fire({
                title: 'خروج از برنامه',
                text: "{{auth()->user()->FullName}}  می خوای خارج بشی؟",//"آیا از خروج از حساب کاربری خود اطمینان دارید؟",
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
        @endauth
           function loding () {
                    @auth
                        @if(auth()->user()->MyNewNotifs()->exists())
                        notif.classList.remove('d-none');
                        @else
                        notif.classList.add('d-none');
                        @endif
                    @endauth
                   loader.remove();
                    content.classList.remove('d-none');
            }
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'توجه',
        confirmButtonText: 'بله',
        text:"{{auth()->user()->FullName}} \n {{session('error')}}"
    });
    @endif
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'عملیات موفقیت آمیز',
        confirmButtonText: 'بله',
        text:"{{auth()->user()->FullName}} \n {{session('success')}}"
    });
    @elseif($errors->any())
    Swal.fire({
                icon: 'error',
                title: 'خطا',
                text:"<?php foreach ($errors->all() as $error) echo $error;?>"
            });
    @endif
    
    </script>  
     @auth
    <script>
        const userid='{{auth()->user()->Id}}';
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
     @endauth
    @yield('script')
</html>
