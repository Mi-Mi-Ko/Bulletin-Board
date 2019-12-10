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
  <div class="card-header">
    投稿作成
  </div>
  <div class="card-body">
    <form action="{{ route('posts#confirmation') }}" method="post" id="create-form">
    @csrf
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-md-2 col-sm-4 col-form-label">タイトル</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="title" placeholder="タイトル">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-md-2 col-sm-4 col-form-label">デスクリプション</label>
        <div class="col-md-6 col-sm-6">
          <textarea type="text" class="form-control" rows="3" name="description" placeholder="デスクリプション"></textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <div class="col-md-4 col-sm-6">
          <button type="submit" class="btn btn-success">投稿確認画面へ</button>
          <button type="reset" class="btn btn-primary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
