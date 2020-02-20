<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <div class="loginmain">
        <ul class="navbar-nav">
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'main' ? ' active' : '' }}">
          <a href="{{ route('main') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('main') }}
          </a>
        </li>
      </div>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
