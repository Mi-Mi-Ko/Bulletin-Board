@extends('layouts.app')

@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif
<div class="card uper">
  <div class="card-header font-weight-bold">
    ユーザー作成
  </div>
  <div class="card-body">
    <form action="{{ route('users#confirmation') }}" method="post" id="create-form">
      @csrf
      <div class="form-group row justify-content-center pt-4">
          <label for="name" class="col-md-2 col-sm-4 col-form-label">名前</label>
          <div class="col-md-6 col-sm-6">
            <input type="text" class="form-control" name="name" placeholder="名前">
          </div>
        </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-md-2 col-sm-4 col-form-label">メールアドレス</label>
        <div class="col-md-6 col-sm-6">
          <input type="email" class="form-control" name="email" placeholder="メールアドレス">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password" class="col-md-2 col-sm-4 col-form-label">パスワード</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" name="password" placeholder="パスワード">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="confirmpassword" class="col-md-2 col-sm-4 col-form-label">確認パスワード</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" name="confirmpassword" placeholder="確認パスワード">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-md-2 col-sm-4 col-form-label">タイプ</label>
          <div class="col-md-6 col-sm-6">
            <select class="form-control" name="type">
              <option>Select type</option>
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-md-2 col-sm-4 col-form-label">電話番号</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="phone" placeholder="電話番号">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">誕生日</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="dob" placeholder="誕生日">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">住所</label>
        <div class="col-md-6 col-sm-6">
          <textarea type="text" class="form-control" name="address" rows="3" placeholder="住所"></textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <div class="col-md-4 col-sm-6">
          <button type="submit" class="btn btn-success">ユーザー確認画面へ</button>
          <button type="reset" class="btn btn-primary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
