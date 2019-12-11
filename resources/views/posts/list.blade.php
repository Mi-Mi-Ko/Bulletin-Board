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
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td>投稿タイトル</td>
                <td>投稿デスクリプション</td>
                <td>投稿したユーザー</td>
                <td>投稿した日</td>
                <td colspan="2">アクション</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Title1</td>
                <td>Description1</td>
                <td>1</td>
                <td>2019/12/06</td>
                <td class="text-center">
                  <a href="{{ route('posts#show',1)}}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                      編集
                  </a>
                </td>
                <td class="text-center">
                  <form action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                    <i class="fas fa-trash-alt"></i>
                      削除
                    </button>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    <div>
  </div>
</div>
@endsection
