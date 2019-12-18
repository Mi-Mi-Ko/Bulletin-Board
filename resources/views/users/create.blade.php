@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    ユーザー登録
  </div>
  <div class="card-body">
    <form action="{{ route('users#confirmation') }}" class="rounded" method="post" id="create-form">
      @csrf
      @if($errors->has('error_msg'))
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="alert alert-light text-danger font-weight-bold col-md-6" role="alert">
            {{ $errors->first('error_msg') }}
          </div>
        </div>
      @endif
      <div class="form-group row justify-content-center pt-4">
        <label for="name" class="col-md-2 col-sm-4 col-form-label">名前</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="名前">
          @if ($errors->has('name'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-md-2 col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-md-6 col-sm-6">
          <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="メールアドレス">
          @if ($errors->has('email'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password" class="col-md-2 col-sm-4 col-form-label">パスワード</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="パスワード">
          @if ($errors->has('password'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password_confirmation " class="col-md-2 col-sm-4 col-form-label">確認パスワード</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" placeholder="確認パスワード">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-md-2 col-sm-4 col-form-label">タイプ</label>
          <div class="col-md-6 col-sm-6">
            <select class="form-control" name="type" value="{{ old('type') }}">
              <option value="">タイプ選択</option>
              <option value="0">管理者</option>
              <option value="1">ユーザー</option>
            </select>
            @if ($errors->has('type'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('type') }}</strong>
            </span>
            @endif
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-md-2 col-sm-4 col-form-label">電話番号</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" placeholder="電話番号">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">生年日</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" value="{{ old('dob') }}" name="dob" placeholder="生年日">
          @if ($errors->has('dob'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('dob') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">住所</label>
        <div class="col-md-6 col-sm-6">
          <textarea type="text" class="form-control" rows="3" name="address" placeholder="住所">{{ old('address') }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">プロファイル</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" class="form-control mb-4" id="profile" onchange="loadPreview(this);" name="profile">
          <img id="preview_img" src="" style="display: none;" width="200" height="150"/>
          @if ($errors->has('profile'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('profile') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <label class="col-md-2 col-sm-4"></label>
        <div class="col-md-6 col-sm-6">
          <button type="submit" class="btn btn-success">ユーザー確認画面へ</button>
          <button type="reset" class="btn btn-primary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
