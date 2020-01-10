<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Post;

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
            ->paginate(config('constant.PAGINATION_RECORDS'));
    }

    /**
     * Search post list
     *
     * @return $postList
     */
    public function searchPostList($title)
    {
        $postQuery = Post::leftjoin('users', function ($leftjoin) {
            $leftjoin->on('posts.create_user_id', '=', 'users.id');
        });
        $postQuery->select('posts.*', 'users.name');
        if ($title) {
            $postQuery->where('title', 'like', '%' . $title . '%');
        }
        return $postQuery->paginate(config('constant.PAGINATION_RECORDS'));
    }

    /**
     * Store post
     *
     * @param Request $request
     * @return void
     */
    public function storePost($request)
    {
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

    /**
     * Store post import file
     *
     * @param Request $request
     * @return void
     */
    public function importPost($data)
    {
        Post::insert($data);
    }
}
