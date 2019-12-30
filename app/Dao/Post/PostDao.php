<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Post;
use Log;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     *
     * @return $postList
     */
    public function getPostList()
    {
        return Post::leftjoin('users', function ($leftjoin) {
            $leftjoin->on('posts.create_user_id', '=', 'users.id');
        })
            ->select('posts.*', 'users.name')
            ->paginate(10);
    }
    /**
     * Store post
     *
     * @param Request $request
     * @return void
     */
    public function storePost($request)
    {
        Log::info("Store post");
        Log::info($request);
        Post::create($request);
    }
    /**
     * Get Post by id
     *
     * @return $post
     */
    public function getPostById($id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }
    /**
     * Update post
     *
     * @param Request $request, $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        Post::whereId($id)->update($request);
    }
    /**
     * Delete post
     *
     * @param Request $request
     * @return void
     */
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }
}
