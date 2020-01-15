@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <i class="fas fa-user"></i>
    ユーザープロファイル
  </div>
  <div class="card-body">
    <form">
      @csrf
      <div class="form-group row justify-content-center">
        <label for="profile" class="col-8 col-form-label"></label>
        <div class="col-4">
          <img src="{{ $user->profile }}" alt="Image" width="200" height="150" />
        </div>
      </div>
      <div class="form-group row justify-content-md-center justify-content-sm-start">
        <label for="name" class="col-4 col-sm-2 col-form-label ">名前</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}" name="name">
        </div>
      </div>
      <div class="form-group row justify-content-md-center justify-content-sm-start">
        <label for="email" class="col-4 col-sm-2 col-form-label">メールアドレス</label>
        <div class="col-8 col-sm-6">
          <input type="email" readonly class="form-control-plaintext" value="{{ $user->email }}" name="email">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="type" class="col-4 col-sm-2 col-form-label">タイプ</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $user->type }}" name="type">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="phone" class="col-4 col-sm-2 col-form-label">電話番号</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $user->phone }}" name="phone">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="dob" class="col-4 col-sm-2 col-form-label">生年日</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $user->dob->format('Y/m/d') }}" name="dob">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="address" class="col-4 col-sm-2 col-form-label">住所</label>
        <div class="col-8 col-sm-6">
          <textarea class="form-control-plaintext" readonly name="address" rows="3">{{ $user->address }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="address" class="col-4 col-sm-2 col-form-label"></label>
        <div class="col-8 col-sm-6">
          <a href="{{ route('users#show', $user->id) }}" class="btn btn-primary">ユーザー編集画面へ</a>
        </div>
      </div>
      </form>
  </div>
</div>
@endsection
