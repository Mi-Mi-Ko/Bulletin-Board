@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <a href="{{ url('/posts') }}"><i class="fas fa-clipboard"></i>投稿一覧 </a>
    <span>/ 投稿編集</span>
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('posts#updateConfirmation', $post->id) }}" id="update-form">
      @csrf
      @method('PUT')
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-sm-2 col-form-label">タイトル</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="title" value="{{ $post->title }}" placeholder="タイトル">
          @if ($errors->has('title'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('title') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-sm-2 col-form-label">デスクリプション</label>
        <div class="col-sm-10 col-md-6">
          <textarea class="form-control" rows="3" justify-content-centers="3" name="description" placeholder="デスクリプション">{{ $post->description }}</textarea>
          @if ($errors->has('description'))
            <span class="help-block text-danger">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="status" class="col-sm-2 col-form-label">ステータス</label>
        <div class="col-sm-10 col-md-6">
          @if ($post->status === 1)
            <div class="custom-control custom-switch">
              <input type="checkbox" checked class="custom-control-input" id="status" name="status">
              <label class="custom-control-label" for="status"></label>
            </div>
          @else
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="status" name="status">
            <label class="custom-control-label" for="status"></label>
          </div>
          @endif
          <input type="hidden" name="id" value="{{ $post->id }}">
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
