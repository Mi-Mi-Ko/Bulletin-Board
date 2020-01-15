@extends('layouts.app')

@section('content')
  <div class="text-center">
    <p class="py-3 my-5 w-50 mx-auto form__msg-info">{{ $message }}</p>
    <a href="{{ route('users#index')}}" class="btn btn-primary">ホームへ</a>
  </div>
@endsection
