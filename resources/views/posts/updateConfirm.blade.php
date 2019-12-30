@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <i class="fas fa-clipboard"></i>
    投稿編集確認
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('posts#update', $post->id) }}">
      @csrf
      @method('PUT')
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-md-2 col-4 col-form-label">タイトル</label>
        <div class="col-md-6 col-8">
          <input type="text" readonly class="form-control-plaintext" value="{{ $post->title }}" name="title" >
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-md-2 col-4 col-form-label">デスクリプション</label>
        <div class="col-md-6 col-8">
          <textarea type="text" class="form-control-plaintext" rows="3" name="description" >{{ $post->description }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="status" class="col-md-2 col-4 col-form-label">ステータス</label>
        <div class="col-md-6 col-8">
          @if ($post->status === 'on')
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" disabled name="status" checked>
              <label class="custom-control-label" for="status"></label>
              <input type="hidden" name="status" value="1">
            </div>
          @else
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" disabled name="status">
              <label class="custom-control-label" for="status"></label>
              <input type="hidden" name="status" value="0">
            </div>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <div class="col-md-4">
          <button type="submit" class="btn btn-success">投稿編集</button>
          <a onClick="window.history.back()" class="btn btn-primary">キャンセル</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
