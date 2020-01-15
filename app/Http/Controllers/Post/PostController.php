<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostsExport;
use App\Http\Controllers\Controller;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Private variable $postService
     */
    private $postService;
    /**
     * Create a new controller instance.
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing post
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getPostList();
        return view('posts.list', compact('posts'));
    }

    /**
     * Display a listing of post.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->checkRequest($request);
        $posts = $this->postService->searchPostList($request->except('_token'));
        $posts->appends(request()->all())->render();
        return view('posts.list', compact("posts"));
    }

    /**
     * Show post creating view
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Validation and go to post confirmation view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function confirmation(Request $request)
    {
        $validator = $this->validateInputForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['posts'] = $request;
        Session::put('POST_INPUT_DATA', $request->all());
        return view('posts.confirm', $data);
    }

    /**
     * back to post create page with old input
     *
     * @return void
     */
    public function backPostInput()
    {
        $oldInputData = Session::get('POST_INPUT_DATA');
        Session::forget('POST_INPUT_DATA');
        return redirect('/posts/create')->withInput($oldInputData);
    }

    /**
     * Store post resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->postService->storePost($request->except('_token'));
        return redirect('/posts')->with('success', '投稿を登録しました。');
    }

    /**
     * Show post updating view
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('posts.update', compact('post'));
    }

    /**
     * Show post update confirmation view
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function updateConfirmation(Request $request)
    {
        $validator = $this->validateUpdateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['post'] = $request;
        Session::put('POST_UPDATE_DATA', $request->all());
        return view('posts.updateConfirm', $data);
    }

    /**
     * back to post update page with old input
     *
     * @return void
     */
    public function backPostUpdate()
    {
        $oldUpdateData = Session::get('POST_UPDATE_DATA');
        Session::forget('POST_UPDATE_DATA');
        $returnRoute = '/posts/' . $oldUpdateData["id"];
        return redirect($returnRoute)->withInput($oldUpdateData);
    }

    /**
     * Update post resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->postService->updatePost($request->except('_method', '_token', 'id'), $id);
        return redirect('/posts')->with('success', '投稿を更新しました。');
    }

    /**
     * Delete post resources
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->postService->deletePost($id);
        return redirect('/posts')->with('success', '投稿を削除しました。');
    }

    /**
     * Show post csv importing view
     *
     * @param
     * @return
     */
    public function getCsv()
    {
        return view('posts.upload');
    }

    /**
     * Import post file
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $validator_one = $this->validateImportFile($request);
        if ($validator_one->fails()) {
            return redirect()->back()->withInput()->withErrors($validator_one);
        }
        $rows = Excel::toArray(new PostsImport, $request->file('uploadFile'));
        foreach ($rows as $key => $row) {
            $validator_two = Validator::make($row, $this->rules(), $this->validationMessages());
            if ($validator_two->fails()) {
                foreach ($validator_two->errors()->messages() as $messages) {
                    foreach ($messages as $error) {
                        return redirect()->back()->withInput()->withErrors($error);
                    }
                }
            }
        }
        Excel::import(new PostsImport, request()->file('uploadFile'));
        return redirect('/posts')->with('success', '投稿ファイルを登録しました。');
    }

    /**
     * Download post list
     *
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    /**
     * Validate post input form request
     *
     * @param Request $request
     * @return void
     */
    private function validateInputForm(Request $request)
    {
        $rules = [
            'title' => 'required|max:255|unique:posts',
            'description' => 'required',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Validate post update form request
     *
     * @param Request $request
     * @return void
     */
    private function validateUpdateForm(Request $request)
    {
        $rules = [
            'title' => 'required|max:255|unique:posts,title,' . $request->id,
            'description' => 'required',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Validate import file request
     *
     * @param Request $request
     * @return void
     */
    private function validateImportFile(Request $request)
    {
        $rules = [
            'uploadFile' => 'required|mimes:xls,xlsx,csv',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Validate post import file
     *
     * @return void
     */
    private function rules(): array
    {
        return [
            '*.title' => 'required|max:255|unique:posts',
            '*.description' => 'required',
        ];
    }

    /**
     * Get custom validation error message
     *
     * @return string
     */
    private function validationMessages()
    {
        return [
            '*.title.required' => trans('ファイルにタイトルが必要です。'),
            '*.title.max' => trans('タイトルは255文字を超えることはできません。'),
            '*.title.unique' => trans('タイトルは既に存在しています。'),
            '*.description.required' => trans('ファイルにデスクリプションが必要です。'),
        ];
    }

    /**
     * Check Request key is missing
     *
     * @param Request $request
     * @return void
     */
    private function checkRequest($request)
    {
        if ($request->missing('title')) {
            $request["title"] = null;
        }
    }
}
