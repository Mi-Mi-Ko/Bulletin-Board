@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    投稿編集
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('posts#updateConfirmation', $posts->id) }}" id="update-form">
      @csrf
      @method('PATCH')
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-sm-2 col-form-label">タイトル</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="title" value="{{ $posts->title }}" placeholder="タイトル">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-sm-2 col-form-label">デスクリプション</label>
        <div class="col-sm-10 col-md-6">
        <textarea class="form-control" name="description" rows="3" justify-content-centers="3" placeholder="デスクリプション">{{ $posts->description }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-sm-2 col-form-label">ステータス</label>
        <div class="col-sm-10 col-md-6">
        <input type="text" readonly class="form-control-plaintext" value="{{$posts->title}}" name="name" >
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-primary">投稿編集確認画面へ</button>
          <button type="reset" class="btn btn-secondary">クリア</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
