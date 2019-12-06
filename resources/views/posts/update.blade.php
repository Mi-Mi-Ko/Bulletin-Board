@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Post Editing
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('posts#update', $posts->id) }}" id="update-form">
    @csrf
    @method('PATCH')
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="title" value="{{ $posts->title }}" placeholder="Title">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10 col-md-6">
        <textarea class="form-control" name="address" rows="3" justify-content-centers="3" placeholder="Description">{{ $posts->description }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-primary">Update Post Data</button>
          <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
