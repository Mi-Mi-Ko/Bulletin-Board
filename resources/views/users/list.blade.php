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
          <a href="{{ route('users#create') }}" class="btn btn-primary">ユーザー登録画面へ</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="bg-primary font-weight-bold">
            <tr>
              <td>名前</td>
              <td>タイプ</td>
              <td>メールアドレス</td>
              <td>作成ユーザー</td>
              <td>電話番号</td>
              <td>生年日</td>
              <td>住所</td>
              <td>作成日</td>
              <td>更新日</td>
              <td colspan="2">アクション</td>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td> {{ $user->name }} </td>
              <td> {{ $user->type }} </td>
              <td> {{ $user->email }} </td>
              <td> {{ $user->create_user_id }} </td>
              <td> {{ $user->phone }} </td>
              <td> {{ $user->dob }} </td>
              <td> {{ $user->address }} </td>
              <td> {{ $user->created_at }} </td>
              <td> {{ $user->updated_at }} </td>
              <td>
                <a href="{{ route('users#show', $user->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                  編集
                </a>
              </td>
              <td>
                <form action="{{ route('users#destroy', $user->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">
                  <i class="fas fa-trash-alt"></i>
                    削除
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    <div>
  </div>
</div>
@endsection
