@extends('layouts.app')

@section('content')
<div class="text-center">
  <p class="my-5 w-50 mx-auto text-danger font-weight-bold">{{ $message }}</p>
  <a href="{{ route('users#index')}}" class="btn btn-primary">ホームへ</a>
</div>
@endsection
