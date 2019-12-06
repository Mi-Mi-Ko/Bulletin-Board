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
    Post Creation
  </div>
  <div class="card-body">
    <form action="{{ route('posts#confirmation') }}" method="post" id="create-form">
    @csrf
      <div class="form-group row justify-content-center pt-4">
        <label for="title" class="col-md-2 col-sm-4 col-form-label">Title</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="description" class="col-md-2 col-sm-4 col-form-label">Description</label>
        <div class="col-md-6 col-sm-6">
          <textarea type="text" class="form-control" rows="3" name="description" placeholder="Description"></textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <div class="col-md-4 col-sm-6">
          <button type="submit" class="btn btn-success">Go to Post Confirm Form</button>
          <button type="reset" class="btn btn-primary">Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
