@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    User Confirmation
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#update', $users->id) }}" id="update-form">
    @csrf
    @method('PATCH')
      <div class="form-group row justify-content-center pt-4">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-10 col-md-6">
            <input type="text" class="form-control" name="name" value="{{ $users->name }}" placeholder="Name">
          </div>
        </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-sm-2 col-form-label">Email Address</label>
        <div class="col-sm-10 col-md-6">
          <input type="email" class="form-control" name="email" value="{{ $users->email }}" placeholder="Email Addtess">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="Type" class="col-sm-2 col-form-label">Type</label>
          <div class="col-sm-10 col-md-6">
            <select class="form-control" name="Type">
              <option>Select type</option>
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-10 col-md-6">
          <input type="text" class="form-control" name="phone" value="{{ $users->phone }}" placeholder="Phone">
        </div>
      </div>
      <div class="form-group row justify-content-center justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">Date of Birth</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="dob" value="{{ $users->dob }}" placeholder="Date of Birth">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10 col-md-6">
        <textarea class="form-control" name="address" row="3" justify-content-centers="3" placeholder="Address">{{ $users->address }}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <label class="col-sm-2"></label>
        <div class="col-sm-10 col-md-6">
          <button type="submit" class="btn btn-primary">Update User Data</button>
          <button type="reset" class="btn btn-primary">Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
