
<div class="trophy_Active  @if(\Route::currentRouteName()!="home") d-none @endif "  >
    <i class="fa fa-trophy"></i>
</div>
<div class="history_Active  @if(\Route::currentRouteName()!="history") d-none @endif " >
    <i class="fa fa-history"></i>
</div>

<div class="commenting_Active @if(\Route::currentRouteName()!="chat.index") d-none @endif " >
    <i class="fa fa-commenting fa-regular"></i>
</div>

<div class="menu2 d-flex">
 
  <div class="d-grid c-pointer" onclick="location.href='{{route('history')}}'">
    @if(\Route::currentRouteName()!="history")
    <i class="fa fa-history"></i>
    <b>تاریخچه</b>
  @else
    <b class="Active">تاریخچه</b>
  @endif
  </div>
  <div class="d-grid c-pointer" onclick="location.href='{{route('home')}}'">
  @if(\Route::currentRouteName()!="home")
    <i class="fa fa-trophy"></i>
    <b>چالش</b>
  @else
    <b class="Active">چالش</b>
  @endif
  </div>
 
  <div class="d-grid c-pointer" onclick="logout()">    
      <i class="fa fa-sign-out-alt"></i>
      <b>خروج</b>
  </div>
  </div>   
       {{-- @if(\Route::currentRouteName()=="home")
        <li>
          <a class="nav-link " role="button" onclick="logout()" >
            <i class="fa fa-2xl fa-sign-out"></i>
          </a>
          
        </li>
        @else
        <li>
          <a class="nav-link " role="button" href="{{route('home')}}" >
            <i class="fa fa-2xl fa-arrow-left"></i>
          </a>
          
        </li>
        @endif --}}