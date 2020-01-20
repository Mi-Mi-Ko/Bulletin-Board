@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header font-weight-bold">
    <i class="fas fa-clipboard"></i>
    投稿一覧
  </div>
  <div class="card-body">
    <div class="uper">
      @if (session()->get('success'))
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('success') }}
      </div>
      @endif
      <form action="{{ route('posts#search') }}" method="post">
        {{ csrf_field() }}
        <div class="form-row mb-4">
          <div class="form-group col-md-4">
            <input type="text" name="title" class="form-control" value="{{ Request::get('title') }}" placeholder="タイトル">
          </div>
          <div class="form-group col-md-2 text-left">
            <button type="submit" class="btn btn-primary pl-4 pr-4">
              検索
            </button>
          </div>
          <div class="form-group col-md-6 text-right">
            <a href="{{ route('posts#getCsv') }}" class="btn btn-primary">アップロード</a>
            <a href="{{ route('posts#export') }}" class="btn btn-primary">ダウンロード</a>
            <a href="{{ route('posts#create') }}" class="btn btn-primary">投稿登録画面へ</a>
          </div>
        </div>
      </form>
      <div class="table-responsive">
        <span class="font-weight-bold">全件: {{ $posts->total() }}</span>
        {{ $posts->links() }}
        <table class="table table-bordered table-striped table-hover text-center">
          <thead class="bg-info font-weight-bold">
            <tr>
              <td width="15%">タイトル</td>
              <td width="48%">デスクリプション</td>
              <td width="12%">投稿したユーザー</td>
              <td width="10%">投稿した日</td>
              <td width="15%" colspan="2">アクション</td>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
            <tr>
              <td>
                <a href="javascript:;" data-toggle="modal" onclick="viewPostData({{ $post }})" data-target="#postDetailModal">
                  {{ $post->title }}
                </a>
              </td>
              <td class="text-left">{{ $post->description }}</td>
              <td>{{ $post->name }}</td>
              @if ( ! $post->created_at )
              <td> {{ $post->created_at }} </td>
              @else
              <td> {{ $post->created_at->format('Y/m/d') }} </td>
              @endif
              <td>
                @if (Session::get('LOGIN_USER')->id == $post->create_user_id || Session::get('LOGIN_USER')->type == 0)
                <a href="{{ route('posts#update', $post->id) }}" class="btn btn-info">
                  <i class="fas fa-edit"></i>編集
                </a>
                <a href="javascript:;" data-toggle="modal" onclick="deletePostData({{ $post }})" data-target="#postDeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>削除
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div>
      </div>
    </div>
    <div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="postDeleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" id="deletePostForm" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <div class="modal-content">
            <div class="modal-header bg-info border-0">
              <h5 class="modal-title font-weight-bold" id="postDeleteModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center font-weight-bold p-4">
              投稿（<strong id="title"></strong>）を削除します。</br>
              よろしいですか？
            </div>
            <div class="modal-footer border-0 mt-4 justify-content-center">
              <button type="button" class="btn btn-success" data-dismiss="modal">いいえ</button>
              <button type="submit" class="btn btn-danger" onclick="postDeletFormSubmit()">はい</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal fade" id="postDetailModal" tabindex="-1" role="dialog" aria-labelledby="postDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title font-weight-bold" id="postDetailModalLabel">投稿明細</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body justify-content-center">
            <form>
              <div class="form-group row">
                <div class="col-4">
                  <label for="postTitle" class="col-form-label">タイトル:</label>
                </div>
                <div class="col-8">
                  <input type="text" class="form-control-plaintext" readonly id="postTitle">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4">
                  <label for="postDescription" class="col-form-label">デスクリプション:</label>
                </div>
                <div class="col-8">
                  <textarea class="form-control-plaintext" rows="3" readonly id="postDescription"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-4">
                  <label for="postStatus" class="col-form-label">ステータス:</label>
                </div>
                <div class="col-8">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" disabled id="postStatus">
                    <label class="custom-control-label" for="status"></label>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endsection
