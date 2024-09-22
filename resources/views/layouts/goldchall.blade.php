<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">
        <title>چالش طلایی فرست کلاس</title>

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
            @media (min-width: 760px)
           {
                                       
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
       </style>
        <style>
        /*.swal2-popup>.swal2-close {  
            color: black !important;
            font-weight: 600;
            font-size: 15pt;
        }*/
		
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
                @if(session('User')->Age<12)
                margin-top: 13px;
                background-color: #dcdcdc;
                color: #404040;
                fill: #404040;
                border: 3px solid #838383;
                box-shadow: 3px 3px 10px -2px #9E9E9E;
                @else
                margin-top: 11px;
                background-color: #4c4c4c;
                color: #b59f64;
                fill: #b59f64;
                border: 3px solid #060606;
                box-shadow: 3px 3px 10px -2px #000000e0;
                @endif
                border-radius: 50px;
                width: 40px;
                height: 40px;
                font-weight: 500;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 21px;
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
                color: #d43d3c;
                font-size: 8pt;
                animation-name: notification;
                animation-duration: 1s;
                animation-iteration-count: infinite;
            }
            .menu2 {
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
                height: 72vh;
                padding: 12px;
            }
            #content
            {
                
                /* justify-content: center;
                display: grid; */
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
            div#title 
            {
            /* font-size: 16pt; */
            /* margin-bottom: 0px !important;
            margin-top: -15px !important; */
            position: relative;
            top:7px;
            }
        </style>     
        @yield('style')
    </head>
    <body class="antialiased overflow-x-hidden" onload="loding() ">
        <div class="container-fluid d-none"  id="content" >
        @if(session('User'))                        
                @include('layouts.menugold')            
        @endif
            
                @yield('content')
        </div>

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
        
        {{-- </div> --}}
    </body>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
    
           function loding () 
           {
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
                                    text:"<?php foreach ($errors->all() as $error) echo $error;?>"
                                });
                        @endif
        }    
    
    </script>  
    
    @yield('script')
</html>
