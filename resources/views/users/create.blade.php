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
    User Creation
  </div>
  <div class="card-body">
    <form action="{{ route('users#confirmation') }}" method="post" id="create-form">
    @csrf
      <div class="form-group row justify-content-center pt-4">
          <label for="name" class="col-md-2 col-sm-4 col-form-label">Name</label>
          <div class="col-md-6 col-sm-6">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
        </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-md-2 col-sm-4 col-form-label">Email Address</label>
        <div class="col-md-6 col-sm-6">
          <input type="email" class="form-control" name="email" placeholder="Email Addtess">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password" class="col-md-2 col-sm-4 col-form-label">Password</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="confirmpassword" class="col-md-2 col-sm-4 col-form-label">Confirm Password</label>
        <div class="col-md-6 col-sm-6">
          <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-md-2 col-sm-4 col-form-label">Type</label>
          <div class="col-md-6 col-sm-6">
            <select class="form-control" name="type">
              <option>Select type</option>
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-md-2 col-sm-4 col-form-label">Phone</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="phone" placeholder="Phone">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="dob" class="col-md-2 col-sm-4 col-form-label">Date of Birth</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" name="dob" placeholder="Date of Birth">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-md-2 col-sm-4 col-form-label">Address</label>
        <div class="col-md-6 col-sm-6">
          <textarea type="text" class="form-control" name="address" rows="3" placeholder="Address"></textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center mt-4">
        <div class="col-md-4 col-sm-6">
          <button type="submit" class="btn btn-success">Go to User Confirm Form</button>
          <button type="reset" class="btn btn-primary">Clear</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
