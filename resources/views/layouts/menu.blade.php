  <nav class="px-2" style="/*column-gap: 20vw;*/height: 9vh;">
    @if (auth()->user()->Age<12)
      <a class="pull-rigth  " href="{{route('home')}}" id="home">
        <img src="{{asset('img/child/logo.png')}}" alt="Logo" class="navimg ">
      </a>
    @else
    <a class="pull-rigth  " href="{{route('home')}}" id="home">
      <img src="{{asset('img/home/logo.png')}}" alt="Logo" class="navimg ">
    </a>
    @endif
    <div class="pull-left d-flex gap-2 px-2" style="margin-top: 2px;">
      <a class="  @if(\Route::currentRouteName()!="chall.details") d-none @endif " href="{{route('chat.index',[$chall->Id??0])}}" id="chat" style="">
      <i class="fa fa-comment-dots fa-regular navicon"></i>
      </a>
      <a class="" href="{{route('notif.index')}}" >
        <div class="d-flex" >
          <i class="fa fa-circle dotnotif d-none" id="notif"></i>
          <i class="fa fa-bell fa-regular navicon"></i>
        </div>
        
      </a>
    </div>
  </nav>