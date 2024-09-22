  <nav class="px-2 mt-0 d-flex justify-content-between" style="/*column-gap: 20vw;*/height: 9vh;">
    
    
      
    
      @if (session('User')->Age<12)
        <a class="" href="{{route('home')}}" id="home">
          <img src="{{asset('img/child/logo.png')}}" alt="Logo" class="navimg ">
        </a>
      @else
      <a class="" href="{{route('home')}}" id="home">
        <img src="{{asset('img/home/logo.png')}}" alt="Logo" class="navimg ">
      </a>
      @endif
      <a href="@yield('backUrl')" id="backicon" style="">
        <i class="fa fa-arrow-left fw-bold navicon"  style="height: 39px;padding-left: 3px;"></i>
      </a>
  </nav>
