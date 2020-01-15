@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <a href="{{ url('/posts') }}"><i class="fas fa-clipboard"></i>投稿一覧 </a>
    <span>/ 投稿登録</span>
  </div>
  <div class="card-body">
    <form action="{{ route('posts#confirmation') }}" method="post" id="create-form">
      @csrf
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-md-2 col-sm-4 col-form-label">タイトル</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" value="{{ old('title') }}" name="title" placeholder="タイトル">
          @if ($errors->has('title'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
          @endif
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-md-2 col-sm-4 col-form-label">デスクリプション</label>
        <div class="col-md-6 col-sm-6">
          <textarea class="form-control" rows="3" name="description" placeholder="デスクリプション">{{ old('description') }}</textarea>
          @if ($errors->has('description'))
          <span class="help-block text-danger">
            <strong>{{ $errors->first('description') }}</strong>
          </span>
          @endif
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
