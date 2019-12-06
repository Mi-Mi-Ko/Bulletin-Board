@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    Posts List
  </div>
  <div class="card-body">
    <div class="uper">
      @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div><br />
      @endif
      <div class="mr-auto mb-4">
        <input type="text" name="title"/>
        <a href="" class="btn btn-primary">Search</a>
        <a href="{{ route('posts#create')}}" class="btn btn-primary">Go to Post Creation Form</a>
        <a href="" class="btn btn-primary">Upload</a>
        <a href="" class="btn btn-primary">Download</a>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <td>Post Title</td>
            <td>Post Description</td>
            <td>Posted User</td>
            <td>Posted Date</td>
            <td colspan="2">Action</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Title1</td>
            <td>Description1</td>
            <td>1</td>
            <td>2019/12/06</td>
            <td><a href="{{ route('posts#show',1)}}" class="btn btn-primary">Edit Post</a></td>
            <td>
              <form action="" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    <div>
  </div>
</div>
@endsection
