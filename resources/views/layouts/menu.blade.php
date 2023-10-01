  <nav class="p-2" style="/*column-gap: 20vw;*/height: 9vh;">
   
    <a class="pull-rigth  @if(\Route::currentRouteName()=="chall.details") d-none @endif " href="{{route('home')}}" id="home">
      <img src="{{asset('img/home/logo.png')}}" alt="Logo" class="navimg ">
    </a>
     <a class="pull-left  " href="{{route('notif.index')}}" >
      <i class="fa fa-circle dotnotif d-none" id="notif"></i>
      <img src="{{asset('img/home/notif.png')}}" alt="Logo" class="navimg ">
    </a>

  </nav>