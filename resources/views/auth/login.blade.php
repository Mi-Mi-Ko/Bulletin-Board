@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Login Form
  </div>
  <div class="card-body">
    <div class="panel panel-default justify-content-center">
      @if (session('loginError'))
          <div class="alert alert-success">
            {{ session('loginError') }}
          </div>
      @endif
      <div class="panel-body">
        <form class="form-horizontal p-4" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row justify-content-center">
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row justify-content-center">
            <label for="password" class="col-md-2 control-label">Password</label>
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-6 col-md-offset-4">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
              </div>
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <div class="col-md-6 offset-md-4 mb-2">
                @if (Route::has('password.request'))
                  <a class="btn btn-link p-0 mb-1" href="{{ route('password.request') }}">
                    {{ __('forget password?') }}
                  </a>
                @endif
              </div>
            </div>

            <div class="form-group row justify-content-center mb-0">
              <div class="col-md-6 offset-md-4 mb-2">
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
                </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
