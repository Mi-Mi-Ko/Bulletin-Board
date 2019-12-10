@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    ユーザー編集
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#updateConfirmation', $users->id) }}" id="update-form">
      @csrf
      @method('PATCH')
      <div class="form-group row justify-content-center pt-4">
        <label for="name" class="col-sm-2 col-form-label">名前</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="name" value="{{ $users->name }}" placeholder="名前">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
        <div class="col-sm-10 col-md-6">
          <input type="email" class="form-control" name="email" value="{{ $users->email }}" placeholder="メールアドレス">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-sm-2 col-form-label">タイプ</label>
          <div class="col-sm-10 col-md-6">
            <select class="form-control" name="type">
              <option>Select type</option>
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-sm-2 col-form-label">電話番号</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="phone" value="{{ $users->phone }}" placeholder="電話番号">
        </div>
      </div>
      <div class="form-group row justify-content-center justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">誕生日</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="dob" value="{{ $users->dob }}" placeholder="誕生日">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-sm-2 col-form-label">住所</label>
        <div class="col-sm-10 col-md-6">
          <textarea class="form-control" name="address" rows="3" justify-content-centers="3" placeholder="住所">{{ $users->address }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <div class="col-sm-8 col-md-8">
          <a class="btn btn-link" href="{{ route('password#showResetForm',$users->id)}}">パスワード変更</a>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-primary">ユーザー編集確認画面へ</button>
          <button type="reset" class="btn btn-secondary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
