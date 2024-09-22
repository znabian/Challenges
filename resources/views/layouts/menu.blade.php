  <nav class="px-2 mt-0" style="/*column-gap: 20vw;*/height: 9vh;">
    <div class="align-items-center d-flex pull-rigth">
      @if (session('User')->Age<12)
        <a class="" href="{{route('home')}}" id="home">
          <img src="{{asset('img/child/logo.png')}}" alt="Logo" class="navimg ">
        </a>
      @else
      <a class="" href="{{route('home')}}" id="home">
        <img src="{{asset('img/home/logo.png')}}" alt="Logo" class="navimg ">
      </a>
      @endif
    <span class="fw-bold" style="font-size: 9pt;font-family: peyda;"> {{session('User')->FullName}}</span>
    </div>
    
    <div class="pull-left d-flex gap-2 px-2" style="margin-top: 2px;">
      
      <a class="  @if(\Route::currentRouteName()=="chall.details" || \Route::currentRouteName()=="cloud.index") d-none @endif " href="{{route('cloud.index')}}" id="uploder" style="">
      <i class="fa fa-folder fa-regular navicon"  style="height: 39px;padding-left: 3px;"></i>
      </a>
      <a class="d-none  @if(\Route::currentRouteName()=="chall.details" || \Route::currentRouteName()=="direct.index") d-none @endif " href="{{route('direct.index')}}"  style="">
      <i class="fa fa-user-tie fw-bold navicon"  style="height: 39px;padding-left: 3px;"></i>
      </a>
      <a class="  @if(\Route::currentRouteName()!="cloud.file.show") d-none @endif " onclick="helpcompress2.show()"  style="">
      <i class="fa fa-question navicon"  style="height: 39px;padding-left: 3px;"></i>
      </a>
      <a class="  @if(\Route::currentRouteName()!="chall.details" || !($chall->Pay??0)) d-none @endif " href="{{route('chat.index',[$chall->Id??0])}}" id="chat" style="">
      <i class="fa fa-comment-dots fa-regular navicon"  style="height: 39px;padding-left: 3px;"></i>
      </a>
      <a class="@if(session('User')->Perm==3) d-none @endif" href="{{route('notif.index')}}" >
        <div class="d-flex position-relative" >
          <i class="fa fa-circle dotnotif d-none" id="notif"></i>
          <i class="fa fa-bell fa-regular navicon"></i>
        </div>
        
      </a>
    </div>
  </nav>
@if(\Route::currentRouteName()!="chat.index" && \Route::currentRouteName()!="direct.index" && !str_contains(\Route::currentRouteName(),"gold"))
  <div class="bg-body col-12 d-flex  p-2">
    <div  class="px-3 col">
      <span style="font-size: 8pt;font-family: 'PEYDA-BLACK';">موجودی کیف پول شما:</span>
    </div>
    <div  class="px-2" style="color: #99885b;font-size: 11pt;">      
    <span id="user_wallet">{{number_format(session('User')->Wallet)}}</span> تومان
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill: #3c3c3c;"><path d="M200-200v-560 560Zm0 80q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v100h-80v-100H200v560h560v-100h80v100q0 33-23.5 56.5T760-120H200Zm320-160q-33 0-56.5-23.5T440-360v-240q0-33 23.5-56.5T520-680h280q33 0 56.5 23.5T880-600v240q0 33-23.5 56.5T800-280H520Zm280-80v-240H520v240h280Zm-160-60q25 0 42.5-17.5T700-480q0-25-17.5-42.5T640-540q-25 0-42.5 17.5T580-480q0 25 17.5 42.5T640-420Z"></path></svg>
    </div>
  </div>
  @endif