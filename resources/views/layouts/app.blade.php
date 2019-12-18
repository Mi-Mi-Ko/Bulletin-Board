<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  </head>
  <body class="app-body">
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
        <div class="container">
          <a class="navbar-brand project-title" href="{{ url('/') }}">
            <i class="fas fa-home"></i>
            {{ config('app.name', 'Bulletin-Board') }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if (Session::has('LOGIN_USER'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <div class="left-sidebar">
                <ul class="nav" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/users') }}">
                    <i class="fas fa-users"></i>
                      ユーザー
                    </a>
                  </li>
                  @if (Session::get('LOGIN_USER')->type == '1')
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('users#profile',1) }}">
                    <i class="fas fa-user"></i>
                      ユーザー
                    </a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/posts') }}">
                    <i class="fas fa-clipboard"></i>
                      投稿
                    </a>
                  </li>
                </ul>
              </div>
              <ul class="navbar-nav ml-auto">
                {{ Session::get('LOGIN_USER')->name }}
                <div class="ml-3 logout-section">
                  <a class="logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>{{ __('ログアウト') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </ul>
            </div>
          @endif
        </div>
      </nav>
      <div class="container mt-4">
        @yield('content')
      </div>
    </div>
  </body>
</html>
<script>
  function loadPreview(input, id) {
    id = id || '#preview_img';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $(id)
                  .attr('src', e.target.result)
                  .width(200)
                  .height(150);
          $(id).css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
    }
 }
</script>
