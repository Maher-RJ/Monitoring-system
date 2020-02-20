<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel bag">
    @include('layouts.navbars.navs.auth')
    @yield('content')
  </div>
</div>