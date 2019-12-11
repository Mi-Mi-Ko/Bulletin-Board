@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    ユーザー一覧
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
          <input type="text" class="form-control" placeholder="名前">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" placeholder="メールアドレス">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" placeholder="Created From">
        </div>
        <div class="form-group col-md-2">
          <input type="text" class="form-control" placeholder="Created To">
        </div>
        <div class="form-group col-md-4">
          <a href="" class="btn btn-primary">検索</a>
          <a href="{{ route('users#create')}}" class="btn btn-primary">ユーザー作成画面へ</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <td>名前</td>
              <td>メールアドレス</td>
              <td>作成ユーザー</td>
              <td>電話番号</td>
              <td>誕生日</td>
              <td>住所</td>
              <td>作成日</td>
              <td>更新日</td>
              <td colspan="2">アクション</td>
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
              <td class="text-center">
                <a href="{{ route('users#show',1)}}" class="btn btn-primary">
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
