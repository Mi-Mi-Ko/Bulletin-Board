<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.list');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    //     return view('posts.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|numeric',
            'type' => 'required|max:255',
            'phone' => 'required|max:255',
            'dob' => 'required|max:255',
            'address' => 'required|max:255',
            'profile' => 'required|max:255',
        ]);
        $show = Post::create($validatedData);

        return redirect('/posts')->with('success', 'Post is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $posts = Post::findOrFail($id);
        Log::info($posts);

        return view('posts.update', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConfirmation(Request $request, $id)
    {
        $data['posts'] = $request;
        Log::info($data);
        return view('posts.updateConfirm', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('Calling post update function');
        return view('posts.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function create()
    {
        return view('posts.create');
    }

    public function confirmation(Request $request)
    {
        $data['posts'] = $request;
        Log::info($data);
        return view('posts.confirm', $data);
    }

    public function getCsv()
    {
        //
        Log::info("Upload view comming");
        return view('posts.upload');
    }
    public function import(Request $request)
    {
        Log::info("Import Action comming");
        $data['posts'] = $request;
        Log::info($data);
        return view('posts.list');
    }
}
