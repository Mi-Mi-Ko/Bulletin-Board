@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="pageNotFound">
    <p class="first-title text-danger">ページが見つかりませんでした。</p>
    <p class="second-title text-danger">
      お探しのページは権限がありません。
    </p>
    <a href="{{ route('users#index')}}" class="btn btn-primary">ユーザー一覧画面へ</a>
  </div>
  </div>
@endsection
