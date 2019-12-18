@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    パスワード更新
  </div>
  <div class="card-body">
    <form action="post">
      <div class="form-group row justify-content-center pt-4">
        <label for="oldPassword" class="col-md-2 col-4 col-form-label">古いパスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" name="oldPassword">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="newPassword" class="col-md-2 col-4 col-form-label">新しいパスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" name="newPassword">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password_confirmation" class="col-md-2 col-4 col-form-label">確認パスワード</label>
        <div class="col-md-6 col-8">
          <input type="password" class="form-control" name="password_confirmation">
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
