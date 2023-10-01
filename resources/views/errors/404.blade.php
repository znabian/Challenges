<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
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
            color: #fff;
            background-image: url("{{asset('img/home/back.png')}}");
            background-attachment: fixed;
            background-size: contain;
            background-repeat: repeat-y;
            /* background-repeat: no-repeat; */
            background-position: center;
            height: 100vh;
            /* height: 88vh; */
            padding: 4vw;
            padding-top: 25%;
        }
        .btn-master
        {
            background: linear-gradient(274deg, #1b1d50, #333870);
            border: 2px solid #5c6096;
            border-radius: 15px;
            color: #686da7;
            padding: 0px;
            width: 74px;
        }
        </style>   
    </head>
    <body class="antialiased overflow-hidden">
        <div class="container"  id="content" >
           
              <div class="content2 mt-5"> 
                <img src="{{asset('img/404.png')}}" class="w-100 m-auto" alt="404">
                <p class="text-center">صفحه مورد نظر یافت نشد
                  <button class="btn-master d-block m-auto p-1 w-50" onclick="location.href='{{route('home')}}'">صفحه اصلی</button>
                </p>
            </div>

        </div>
    </body>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</html>