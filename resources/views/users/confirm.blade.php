@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    User Confirmation
  </div>
  <div class="card-body">
    <form method="post" action="{{ route('users#store') }}">
    @csrf
      <div class="form-group row justify-content-center pt-4">
          <label for="name" class="col-2 col-form-label">Name</label>
          <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" value="{{$users->name}}" name="name" >
          </div>
        </div>
      <div class="form-group row justify-content-center">
        <label for="email" class="col-2 col-form-label">Email Address</label>
        <div class="col-6">
          <input type="email" readonly class="form-control-plaintext" value="{{$users->email}}" name="email">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="password" class="col-2 col-form-label">Password</label>
        <div class="col-6">
          <input type="password" readonly class="form-control-plaintext" value="{{$users->password}}" name="password">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="type" class="col-2 col-form-label">Type</label>
          <div class="col-6">
            <input type="text" readonly class="form-control-plaintext" value="{{$users->type}}" name="type">
          </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="phone" class="col-2 col-form-label">Phone</label>
        <div class="col-6">
          <input type="text" readonly class="form-control-plaintext" value="{{$users->phone}}" name="phone">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="dob" class="col-2 col-form-label">Date of Birth</label>
        <div class="col-6">
          <input type="text" readonly class="form-control-plaintext" value="{{$users->dob}}" name="dob">
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <label for="address" class="col-2 col-form-label">Address</label>
        <div class="col-6">
          <textarea class="form-control-plaintext" readonly name="address" rows="3">{{$users->address}}</textarea>
        </div>
      </div>
      <div class="form-group row justify-content-center">
        <div class="col-8">
          <button type="submit" class="btn btn-success">Create User</button>
          <a href="{{ route('users#create')}}" class="btn btn-primary">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
