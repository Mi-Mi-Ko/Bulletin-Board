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
    <script src="//code.jquery.com/jquery-1.11.3.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

  </head>
  <body class="app-body">
    <div id="app">
        @if(Request::path() === '/' || Request::path() === 'login')
          <nav class="navbar navbar-expand-md navbar-light shadow-sm">
        @else
          <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar-margin">
        @endif
        <div class="container">
          <a class="navbar-brand project-title" href="{{ url('/users') }}">
            <i class="fas fa-home"></i>
            <span class="font-weight-bold">
              {{ config('app.name', 'Bulletin-Board') }}
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          @if (Session::has('LOGIN_USER'))
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
      @if(Request::path() === '/' || Request::path() === 'login')
      @else
        <div class="sidebar">
          @if (Session::has('LOGIN_USER'))
            <ul class="nav flex-column pt-4">
            @if (Request::segment(1) === 'users' && Request::segment(2) !== 'profile')
              <li class="myNav-item active">
            @else
              <li class="myNav-item">
            @endif
                <a class="nav-link" href="{{ url('/users') }}">
                  <i class="fas fa-users"></i>&nbsp;ユーザー
                </a>
              </li>
              @if (Session::get('LOGIN_USER')->type === '1')
              @if (Request::segment(2) === 'profile')
              <li class="myNav-item active">
              @else
                <li class="myNav-item">
              @endif
                  <a class="nav-link" href="{{ route('users#profile', Session::get('LOGIN_USER')->id) }}">
                    <i class="fas fa-user"></i>&nbsp;ユーザー
                  </a>
                </li>
              @endif
              @if (Request::segment(1) === 'posts')
                <li class="myNav-item active">
              @else
                <li class="myNav-item">
              @endif
                <a class="nav-link" href="{{ url('/posts') }}">
                  <i class="fas fa-clipboard"></i>&nbsp;投稿
                </a>
              </li>
            </ul>
          @endif
        </div>
      @endif
      @if(Request::path() === '/' || Request::path() === 'login')
        <div class="content pt-4">
          <div class="container m-auto">
      @else
        <div class="content content-margin pt-4">
          <div class="container-fluid">
      @endif
            @yield('content')
          </div>
      </div>
    </div>
  </body>
</html>
<script>
  // load user profile preview
  function loadPreview(input, id)
  {
    id = id || '#previewImage';
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
  // view post data
  function viewPostData(post)
  {
    $("#postTitle").val(post.title);
    $("#postDescription").html(post.description);
    if (post.status === 1) {
      document.getElementById("postStatus").checked = true;
    } else {
      document.getElementById("postStatus").checked = false;
    }
  }
  // post delete data preparation
  function deletePostData(post)
  {
    var url = '{{ route("posts#delete", ":id") }}';
    url = url.replace(':id', post.id);
    $("#deletePostForm").attr('action', url);
    $("#title").html(post.title);
  }
  // post delete form submit
  function postDeletFormSubmit()
  {
    $("#deletePostForm").submit();
  }
  // view user data
  function viewUserData(user)
  {
    var userDob = getFormattedDate(user.dob);
    $("#userNamae").val(user.name);
    $("#userEmail").val(user.email);
    $("#userAddress").val(user.address);
    $("#userDob").val(userDob);
    $("#userPhone").val(user.phone);
    // $("#profile").attr('src', user.profile);
    // $("#profile").css("border-radius", "50%");
  }
  // format date
  function getFormattedDate(input) {
    var datePart = input.match(/\d+/g),
    year = datePart[0],
    month = datePart[1],
    day = datePart[2];
    return year + '/' + month + '/' + day;
  }
  // user delete data preparation
  function deleteUserData(user)
  {
    var url = '{{ route("users#delete", ":id") }}';
    url = url.replace(':id', user.id);
    $("#deletUserForm").attr('action', url);
    $("#userName").html(user.name);
  }
  // user delete form submit
  function userDeletFormSubmit()
  {
    $("#deletUserForm").submit();
  }
  // reset alert
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
    });
  }, 3000);
</script>
