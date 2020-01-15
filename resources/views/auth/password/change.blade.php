@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    パスワード更新
  </div>
  <div class="card-body">
    <form action="{{ route('password#change') }}" method="post" id="change-password-form">
      {{ csrf_field() }}
      <div class="form-group row justify-content-center pt-4">
        <label for="current_password" class="col-md-2 col-4 col-form-label" autocomplete="current-password">現在パスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" value="{{ old('current_password') }}" name="current_password">
          @if ($errors->has('current_password'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('current_password') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="new_password" class="col-md-2 col-4 col-form-label">新しいパスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" value="{{ old('new_password') }}" name="new_password" autocomplete="current-password">
          @if ($errors->has('new_password'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('new_password') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password_confirmation" class="col-md-2 col-4 col-form-label">認証パスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" autocomplete="current-password">
          @if ($errors->has('password_confirmation'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center pt-2">
        <div class="col-md-4">
          <button type="submit" class="btn btn-success">パスワード変更</button>
          <button type="reset" class="btn btn-secondary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
