@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    ユーザー編集確認
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#store', $users->id) }}">
      @csrf
        <div class="form-group row justify-content-md-center pt-4">
          <label for="name" class="col-4 col-sm-2 col-form-label ">名前</label>
          <div class="col-8 col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value="{{$users->name}}" name="name" >
          </div>
        </div>
        <div class="form-group row justify-content-md-center justify-content-sm-start">
          <label for="email" class="col-4 col-sm-2 col-form-label">メールアドレス</label>
          <div class="col-8 col-sm-6">
            <input type="email" readonly class="form-control-plaintext" value="{{$users->email}}" name="email">
          </div>
        </div>
        <div class="form-group row justify-content-md-center">
          <label for="type" class="col-4 col-sm-2 col-form-label">タイプ</label>
            <div class="col-8 col-sm-6">
              <input type="text" readonly class="form-control-plaintext" value="{{$users->type}}" name="type">
            </div>
        </div>
        <div class="form-group row justify-content-md-center">
          <label for="phone" class="col-4 col-sm-2 col-form-label">電話番号</label>
          <div class="col-8 col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value="{{$users->phone}}" name="phone">
          </div>
        </div>
        <div class="form-group row justify-content-md-center">
          <label for="dob" class="col-4 col-sm-2 col-form-label">誕生日</label>
          <div class="col-8 col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value="{{$users->dob}}" name="dob">
          </div>
        </div>
        <div class="form-group row justify-content-md-center">
          <label for="address" class="col-4 col-sm-2 col-form-label">住所</label>
          <div class="col-8 col-sm-6">
            <textarea class="form-control-plaintext" readonly name="住所" rows="3">{{$users->address}}</textarea>
          </div>
        </div>
        <div class="form-group row justify-content-center mt-4">
          <label class="col-sm-2"></label>
          <div class="col-sm-10 col-md-6">
            <button type="submit" class="btn btn-success">ユーザー編集</button>
            <a href="{{ route('users#update', $users->id)}}" class="btn btn-primary">キャンセル</a>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection