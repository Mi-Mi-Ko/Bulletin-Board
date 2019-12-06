@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
    User List
  </div>
  <div class="card-body">
    <div class="uper">
      @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div><br />
      @endif
      <div class="mr-auto mb-4">
        <a href="{{ route('users#create')}}" class="btn btn-primary">Go to User Creation Form</a>
      </div>
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Name</td>
              <td>Email</td>
              <td>Created User</td>
              <td>Phone</td>
              <td>Birth Date</td>
              <td>Address</td>
              <td>Created Date</td>
              <td>Updated Date</td>
              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>Mi Mi Ko</td>
                <td>mimiko@gmail.com</td>
                <td>1</td>
                <td>09421956327</td>
                <td>1992/12/05</td>
                <td>Yangon</td>
                <td>2018/12/05</td>
                <td>2018/12/05</td>
                <td><a href="{{ route('users#show',1)}}" class="btn btn-primary">Edit User</a></td>
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
