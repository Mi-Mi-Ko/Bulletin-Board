<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Log;
use Validator;

class PostController extends Controller
{
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
        //
        $posts = $this->postService->getPostList();
        Log::info('Return Data::');
        return view('posts.list', compact('posts'));
    }

    /**
     * Show post creating view
     *
     * Return void
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
        $validator = $this->validateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['posts'] = $request;
        return view('posts.confirm', $data);
    }

    /**
     * Validate post request
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Store post resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|max:255',
        //     'password' => 'required|numeric',
        //     'type' => 'required|max:255',
        //     'phone' => 'required|max:255',
        //     'dob' => 'required|max:255',
        //     'address' => 'required|max:255',
        //     'profile' => 'required|max:255',
        // ]);
        // $show = Post::create($validatedData);

        return redirect('/posts')->with('success', 'Post is successfully saved');
    }

    /**
     * Show post updating view
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
        $posts = Post::findOrFail($id);
        Log::info($posts);

        return view('posts.update', compact('posts'));
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
        $data['post'] = $request;
        Log::info($data);
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
        Log::info('Calling post update function');
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $posts = $this->postService->updatePost($validatedData, $id);
        Log::info('Return Data::');
        return redirect('/posts')->with('success', '投稿を登録しました。');
    }

    /**
     * Delete post resources
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        Log::info("Import Action comming");
        $data['posts'] = $request;
        Log::info($data);
        return view('posts.list');
    }
}
