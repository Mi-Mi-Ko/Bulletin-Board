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
        <div class="form-group col-md-2 text-center">
          <a href="" class="btn btn-primary pl-4 pr-4">検索</a>
        </div>
        <div class="form-group col-md-2">
          <a href="{{ route('users#create') }}" class="btn btn-primary">ユーザー登録画面へ</a>
        </div>
      </div>
      <div class="table-responsive">
        {{ $users->links() }}
        <table class="table table-bordered table-striped table-hover table-sm text-center">
          <thead class="bg-info font-weight-bold">
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
              <td>
                <a href="javascript:;" data-toggle="modal" onclick="viewUserData({{$user}})"
                      data-target="#userDetailModal">
                      {{ $user->name }}
                </a>
              </td>
              <td> {{ $user->type }} </td>
              <td> {{ $user->email }} </td>
              <td> {{ $user->create_user_id }} </td>
              <td> {{ $user->phone }} </td>
              <td> {{ $user->dob->format('Y/m/d') }} </td>
              <td> {{ $user->address }} </td>
              <td> {{ $user->created_at }} </td>
              <td> {{ $user->updated_at }} </td>
              <td>
                <a href="{{ route('users#show', $user->id) }}" class="btn btn-info">
                <i class="fas fa-edit"></i>
                  編集
                </a>
              </td>
              <td>
                <a href="javascript:;" data-toggle="modal" onclick="deleteUserData({{$user}})"
                    data-target="#userDeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>削除
                  </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    <div>
  </div>
</div>
<div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="deletUserForm" method="post">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title font-weight-bold" id="userDeleteModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center font-weight-bold p-4">
          ユーザー（<strong id="userName"></strong>）を削除します。</br>
          よろしいですか？
        </div>
        <div class="modal-footer border-0 mt-4 justify-content-center">
          <button type="button" class="btn btn-success" data-dismiss="modal">いいえ</button>
          <button type="submit" class="btn btn-danger"　onclick="userDeletFormSubmit()">はい</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="userDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="userDetailModalLabel">ユーザー明細</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group row">
            <div class="col-4">
              <label for="userNamae" class="col-form-label">名前:</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control-plaintext" readonly id="userNamae">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="userEmail" class="col-form-label">メールアドレス:</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control-plaintext" readonly id="userEmail">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="userPhone" class="col-form-label">電話番号:</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control-plaintext" readonly id="userPhone">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="userDob" class="col-form-label">生年日:</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control-plaintext" readonly id="userDob">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
              <label for="userAddress" class="col-form-label">住所:</label>
            </div>
            <div class="col-8">
              <input type="text" class="form-control-plaintext" readonly id="userAddress">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
