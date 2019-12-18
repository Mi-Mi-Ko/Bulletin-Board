@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    投稿一覧
  </div>
  <div class="card-body">
    <div class="uper">
      @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div><br />
      @endif
      <div class="form-row mb-4">
        <div class="form-group col-md-2">
          <input type="text" class="form-control" placeholder="タイトル">
        </div>
        <div class="form-group col-md-2">
          <a href="" class="btn btn-primary">検索</a>
        </div>
        <div class="form-group col-md-2">
          <a href="{{ route('posts#create')}}" class="btn btn-primary">投稿登録画面へ</a>
        </div>
        <div class="form-group col-md-2">
          <a href="{{ route('posts#getCsv')}}" class="btn btn-primary">アップロード</a>
        </div>
        <div class="form-group col-md-2">
          <a href="" class="btn btn-primary">ダウンロード</a>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center">
            <thead class="bg-primary font-weight-bold">
              <tr>
                <td>タイトル</td>
                <td>Status</td>
                <td>デスクリプション</td>
                <td>投稿したユーザー</td>
                <td>投稿した日</td>
                <td colspan="2">アクション</td>
              </tr>
            </thead>
            <tbody>
              @foreach($posts as $post)
                <tr>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->status }}</td>
                  <td class="text-left">{{ $post->description }}</td>
                  <td>{{ $post->create_user_id }}</td>
                  <td>{{ $post->created_at }}</td>
                  <td><a href="{{ route('posts#update', $post->id) }}" class="btn btn-primary">編集</a></td>
                  <td>
                    <form action="{{ route('posts#destroy', $post->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">削除</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $posts->links() }}
        </div>
      <div>
  </div>
</div>
@endsection
