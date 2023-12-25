<div class="d-flex justify-content-center menu2" style="bottom:8px">
    
  <nav class="" >
    <ul class="d-flex justify-content-around list-inline p-1 position-relative">
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
      <a href="javascript:logout();" class="text-decoration-none">
        <li>
            <i class="fa fa-sign-out-alt"></i>
            خروج
        </li>
      </a>
    </ul>
  </nav>
  
</div>