@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <a href="{{ url('/posts') }}"><i class="fas fa-clipboard"></i>投稿一覧 </a>
    <span>/ 投稿アップロード</span>
  </div>
  <div class="card-body">
    @if ($errors->any())
    <div class="row justify-content-center">
      <div class="col-md-6 alert alert-danger pb-0">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif
    <form action="{{ route('posts#import') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group row justify-content-center pt-4">
        <div class="col-md-6 col-8">
          <input type="file" class="form-control" name="uploadFile" id="uploadFile">
        </div>
      </div>
      <div class="form-group row justify-content-center pt-2">
        <div class="col-md-6 col-8">
          <button class="btn btn-primary">投稿ファイルインポート</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
