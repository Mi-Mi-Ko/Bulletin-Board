<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostsExport;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

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
        return view('posts.confirm', $data);
    }

    /**
     * Store post resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->postService->store($request->except('_token'));
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
    public function updateConfirmation(Request $request, $id)
    {
        $validator = $this->validateUpdateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['post'] = $request;
        return view('posts.updateConfirm', $data);
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
    public function destroy($id)
    {
        $this->postService->delete($id);
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
        //
        Log::info("Upload view comming");
        return view('posts.upload');
    }

    /**
     *
     *
     * @param
     * @return
     */
    public function import(Request $request)
    {
        Log::info("Calling import-----");
        $data['posts'] = $request;
        Log::info($data);
        return view('posts.list');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        Log::info("Calling export-----");
        // $this->postService->export();
        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    /**
     * Validate post input request
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
     * Validate post update request
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
}
