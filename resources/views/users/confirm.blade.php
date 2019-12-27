@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    ユーザー確認
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group row justify-content-center">
        <label for="profile" class="col-8 col-form-label"></label>
        <div class="col-4">
           <input type="hidden" class="form-control mb-4" id="profile" name="profile" value="{{url('/images/' . Session::get('LOGIN_USER')->id . '/'. $user->profile->getClientOriginalName())}}">
          <img src="{{url('/images/' . Session::get('LOGIN_USER')->id . '/'. $user->profile->getClientOriginalName())}}" alt="Image" width="200" height="150"/>
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="name" class="col-4 col-sm-2 col-form-label ">名前</label>
        <div class="col-8 col-sm-6">
          <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}" name="name" >
        </div>
      </div>
      <div class="form-group row justify-content-md-center justify-content-sm-start">
        <label for="email" class="col-4 col-sm-2 col-form-label">メールアドレス</label>
        <div class="col-8 col-sm-6">
        <input type="email" readonly class="form-control-plaintext" value="{{ $user->email }}" name="email">
      </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="password" class="col-4 col-sm-2 col-form-label">パスワード</label>
        <div class="col-8 col-sm-6">
          <input type="password" readonly class="form-control-plaintext" value="{{ $user->password }}" name="password">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="type" class="col-4 col-sm-2 col-form-label">タイプ</label>
        <div class="col-8 col-sm-6">
        <!-- @if ($user->type == 0)
          <input type="text" readonly class="form-control-plaintext" value="0" name="type">
        @else
          <input type="text" readonly class="form-control-plaintext" value="1" name="type">
        @endif -->

        <select disabled class="form-control">
          @if ($user->type == 0)
            <option value="0" seleted name="type">管理者</option>
          @else
            <option value="1" seleted name="type">ユーザー</option>
          @endif
        </select>
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
          <input type="text" readonly class="form-control-plaintext" format="yyyy/mm/dd" value="{{ $user->dob }}" name="dob">
        </div>
      </div>
      <div class="form-group row justify-content-md-center">
        <label for="address" class="col-4 col-sm-2 col-form-label">住所</label>
        <div class="col-8 col-sm-6">
          <textarea class="form-control-plaintext" readonly rows="3" name="address">{{ $user->address }}</textarea>
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
