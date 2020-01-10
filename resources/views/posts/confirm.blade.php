@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    投稿確認
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('posts#store') }}">
    @csrf
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-md-2 col-4 col-form-label">タイトル</label>
        <div class="col-md-6 col-8">
          <input type="text" readonly class="form-control-plaintext" value="{{ $posts->title }}" name="title" >
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-md-2 col-4 col-form-label">デスクリプション</label>
        <div class="col-md-6 col-8">
          <textarea type="text" readonly class="form-control-plaintext" rows="3" name="description" >{{ $posts->description }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <div class="col-md-4">
          <button type="submit" class="btn btn-success">投稿登録</button>
          <a href="{{ url('/posts/backInput') }}" class="btn btn-secondary">キャンセル</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
