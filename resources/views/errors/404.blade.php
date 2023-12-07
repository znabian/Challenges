<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">
        <title>چالش فرست کلاس-صفحه یافت نشد</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="{{ asset('css/font.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
        <link rel="stylesheet" href="{{ asset('fontawesome-6.4.2/css/all.css') }}">
        <!-- Styles -->
        <style>
            .content2
            {
                overflow-y: auto;
                height: 58vh;
                padding: 12px;
            }
           @media (min-width: 764px)
            {                
                body
                {
                /* width: 51%; */
                width: 46vw;
                margin: 0 auto;
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
            #content
            {
            color: #535353;
            /* background-image: url("http://www.xe-non.ir/img/home/back.png"); 
            background-attachment: fixed;
            background-size: contain;
            background-repeat: repeat-y;*/
            /* background-repeat: no-repeat; */
            /* background-position: center; */
            height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
            padding-top: 25%;
        }
        .btn-master
        {
            background: linear-gradient(274deg, #c4ae75, #dcc5a1);
            border: 2px solid #f4f5f0;
            border-radius: 15px;
            color: #fffffd;
            padding: 0px;
            width: 74px;
            box-shadow: -1px 2px 12px -2px #c5c5c5;
        }
        .txt404
         {
            color: #d8c199;
            font-size: 83pt;
            font-weight: bold;
            text-shadow: 11px 1px #c7b17b;
            text-align: center;
        }
        .des404 {
            font-weight: 500;
            font-size: 10pt;
            font-family: peyda;
            color: #878787;
            text-align: center;
        }
        </style>   
    </head>
    <body class="antialiased overflow-hidden">
        <div class="container"  id="content" >
           
            <div class="content2 d-flex flex-column gap-3 justify-content-center mt-5"> 
                <h1 class="txt404">404</h1>
                <b class="text-center h4">
                    صفحه یا فایل  درخواست شده وجود ندارد
                </b>
                <span class="des404">
                    صفحه مورد نظر در دسترس نیست. ممکن است نشانی صفحه اشتباه وارد شده باشد. چنانچه توسط لینکی از دیگر صفحات به این خطا رسیده اید، لطفا نشانی آن را به پشتیبان خود اطلاع دهید.

                </span>
                  <button class="btn-master d-block mx-auto p-3 w-50" onclick="location.href='{{route('home')}}'">صفحه اصلی</button>
                
            </div>

        </div>
    </body>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</html>