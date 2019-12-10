@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    投稿アップロード
  </div>
  <div class="card-body">
    <form action="{{ route('posts#import')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group row justify-content-center pt-4">
        <div class="col-md-6 col-8">
          <input type="file" name="file" class="form-control">
        </div>
      </div>
      <div class="form-group row justify-content-center pt-2">
        <div class="col-md-6 col-8">
          <button class="btn btn-primary">投稿ファイルインポート</button>
        </div>
      </div>
    </form>
    <form>
      <div class="form-group">
        <label for="exampleFormControlFile1">Example file input</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
    </form>
  </div>
</div>
@endsection
