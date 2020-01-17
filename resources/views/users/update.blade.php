@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <a href="{{ url('/users') }}"><i class="fas fa-user"></i>ユーザー一覧 </a>
    <span>/ ユーザー編集</span>
  </div>
  <div class="card-body">
    <form action="{{ route('users#updateConfirmation', $user->id) }}" method="POST" enctype="multipart/form-data" id="update-form">
      @csrf
      <div class="form-group row justify-content-center">
        <label for="profile" class="col-8 col-form-label"></label>
        <div class="col-4 pl-0 mb-4">
          <img src="{{ $user->profile }}" alt="Image" width="200" height="150" />
          <input type="hidden" class="form-control" id="hiddenProfile" name="hiddenProfile" value="{{ $user->profile }}">
          <input type="hidden" name="id" value="{{ $user->id }}">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="name" class="col-sm-2 col-form-label">名前</label>
        <div class="col-sm-10 col-md-6">
          @if (old('name'))
          <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="名前">
          @else
          <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="名前">
          @endif
          @if ($errors->has('name'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-sm-2 col-form-label">メールアドレス</label>
        <div class="col-sm-10 col-md-6">
          @if (old('email'))
          <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="メールアドレス">
          @else
          <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="メールアドレス">
          @endif
          @if ($errors->has('email'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-sm-2 col-form-label">タイプ</label>
        <div class="col-sm-10 col-md-6">
          @if (old('type') != null)
          <select class="form-control" name="type">
            <option>タイプ選択</option>
            @if (old('type') == 0)
            <option value="0" selected>管理者</option>
            <option value="1" 　>ユーザー</option>
            @else
            　<option value="0">管理者</option>
            <option value="1" selected>ユーザー</option>
            @endif
          </select>
          @else
          <select class="form-control" name="type">
            <option>タイプ選択</option>
            @if ($user->type == 0)
            <option value="0" selected>管理者</option>
            <option value="1" 　>ユーザー</option>
            @else
            　<option value="0">管理者</option>
            <option value="1" selected>ユーザー</option>
            @endif
          </select>
          @endif
          @if ($errors->has('type'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('type') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-sm-2 col-form-label">電話番号</label>
        <div class="col-sm-10 col-md-6">
          @if (old('phone'))
          <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="電話番号">
          @else
          <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="電話番号">
          @endif
          @if ($errors->has('phone'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('phone') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">生年日</label>
        <div class="col-md-6 col-sm-6">
          @if (old('dob'))
          <input type="text" class="form-control" name="dob" value="{{ old('dob') }}" placeholder="生年日">
          @else
          <input type="text" class="form-control" name="dob" value="{{ $user->dob->format('Y/m/d') }}" placeholder="生年日">
          @endif
          @if ($errors->has('dob'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('dob') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-sm-2 col-form-label">住所</label>
        <div class="col-sm-10 col-md-6">
          @if (old('address'))
          <textarea class="form-control" rows="3" justify-content-centers="3" name="address" placeholder="住所">{{ old('address') }}</textarea>
          @else
          <textarea class="form-control" rows="3" justify-content-centers="3" name="address" placeholder="住所">{{ $user->address }}</textarea>
          @endif
          @if ($errors->has('address'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('address') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">プロファイル</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" class="form-control mb-4" id="profile" name="profile" accept=".png,.jpg,jpeg" onchange="loadPreview(this);">
          @if ($errors->has('profile'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('profile') }}</strong>
          </span>
          @endif
          <img id="previewImage" src="" style="display: none;" width="200" height="150" />
        </div>
      </div>
      @if (Session::get('LOGIN_USER')->id === $user->id)
      <div class="form-group row justify-content-center">
        <div class="col-sm-8 col-md-8">
          <a class="btn btn-link" href="{{ route('password#showChangePasswordForm',$user->id) }}">パスワード変更</a>
        </div>
      </div>
      @endif
      <div class="form-group row justify-content-center mt-4">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-primary">ユーザー編集確認画面へ</button>
          <button type="reset" onClick="clearForm()" class="btn btn-secondary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
