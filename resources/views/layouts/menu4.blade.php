<div class="d-flex justify-content-center menu2" style="bottom:8px">
    
  <nav class="" >
    <ul class="d-flex justify-content-around list-inline p-1 position-relative">
      <a href="{{route('direct.index')}}" class="@if(\Route::currentRouteName()=="direct.index") active @endif  text-decoration-none">
        <li>
            <i class="fa fa-user-tie"></i>
            <span id="directmn">ارتباط مستقیم </span>
        </li>
      </a>
      
      @if(session('User')->FisrtClass==2)
      <a href="{{route('Offline')}}" class="@if(\Route::currentRouteName()=="Offline") active @endif  text-decoration-none" >
        <li>
            <i class="fa fa-book-open-reader"></i>
            آفلاین
        </li>
      </a>
      @endif
      <a href="{{route('history')}}" class="@if(\Route::currentRouteName()=="history") active @endif  text-decoration-none">
        <li>
            <i class="fa fa-shopping-basket"></i>
            بازارچه
        </li>
      </a>  
      <a href="{{route('home')}}" class="@if(\Route::currentRouteName()=="home") active @endif  text-decoration-none" >
        <li class="">
            <i class="fa fa-shop"></i>
            کف بازار
        </li>
      </a>
      <a href="{{route('gold.landing')}}" class="@if(str_contains(\Route::currentRouteName(),"gold")) active @endif  text-decoration-none" >
        <li style="color: goldenrod;">
            <i class="fa fa-star"></i>
            <span style="font-size: 5pt;">چالش طلایی</span>
        </li>
      </a>
      @if(session('User')->FisrtClass==1)
      <a href="{{route('abstract')}}" class="@if(\Route::currentRouteName()=="abstract") active @endif  text-decoration-none" >
        <li>
            <i class="fa fa-book"></i>
            چکیده
        </li>
      </a>
      @endif
      <a href="javascript:logout();" class="text-decoration-none">
        <li>
            <i class="fa fa-sign-out-alt"></i>
            خروج
        </li>
      </a>
    </ul>
  </nav>
  
</div>