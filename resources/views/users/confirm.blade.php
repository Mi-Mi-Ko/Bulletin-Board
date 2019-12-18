@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    ユーザー確認
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group row justify-content-md-center pt-4">
        <label for="name" class="col-4 col-sm-2 col-form-label ">名前</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $users->name }}" name="name" >
        </div>
      </div>
      <div class="form-group row justify-content-md-center justify-content-sm-start">
        <label for="email" class="col-4 col-sm-2 col-form-label">メールアドレス</label>
        <div class="col-8 col-sm-6">
        <input type="email" readonly class="form-control-plaintext" value="{{ $users->email }}" name="email">
      </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="password" class="col-4 col-sm-2 col-form-label">パスワード</label>
        <div class="col-8 col-sm-6">
          <input type="password" readonly class="form-control-plaintext" value="{{ $users->password }}" name="password">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="type" class="col-4 col-sm-2 col-form-label">タイプ</label>
        <div class="col-8 col-sm-6">
        @if({{ $users->type }} === 0)
          <input type="text" readonly class="form-control-plaintext" selected value="管理者" name="type">
        @else
          <input type="text" readonly class="form-control-plaintext" selected value="ユーザー" name="type">
        @endif
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="phone" class="col-4 col-sm-2 col-form-label">電話番号</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $users->phone }}" name="phone">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="dob" class="col-4 col-sm-2 col-form-label">生年日</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $users->dob }}" name="dob">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="address" class="col-4 col-sm-2 col-form-label">住所</label>
        <div class="col-8 col-sm-6">
          <textarea class="form-control-plaintext" readonly rows="3" name="address">{{ $users->address }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center hidden">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">プロファイル</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" id="profile" onchange="loadPreview(this);" class="form-control mb-4" name="profile">
          <img id="preview_img" src="" style="display: none;" width="200" height="150"/>
          @if($errors->has('profile'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('profile') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-success">ユーザー登録</button>
          <a onClick="window.history.back()" class="btn btn-primary">キャンセル</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
