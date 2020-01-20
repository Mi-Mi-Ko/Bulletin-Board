<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Post;
use Illuminate\Support\Facades\Session;

class PostDao implements PostDaoInterface
{
    /**
     * Get Post List
     *
     * @return $postList
     */
    public function getPostList()
    {
        if (Session::get('LOGIN_USER')->type == 0) {
            $postQuery = Post::leftjoin('users', function ($leftjoin) {
                $leftjoin->on('posts.create_user_id', '=', 'users.id');
            });
            $postQuery->select('posts.*', 'users.name', 'users.type');
            return $postQuery->paginate(config('constant.PAGINATION_RECORDS'));
        } else {
            $postQuery = Post::leftjoin('users', function ($leftjoin) {
                $leftjoin->on('posts.create_user_id', '=', 'users.id');
            });
            $postQuery->select('posts.*', 'users.name', 'users.type');
            $postQuery->whereNotIn('posts.id', function ($q) {
                $q->select('id')
                    ->where('status', '=',  0)
                    ->where('create_user_id', '<>',  Session::get('LOGIN_USER')->id)
                    ->from('posts');
            });

            return $postQuery->paginate(config('constant.PAGINATION_RECORDS'));
        }
    }

    /**
     * Search post list
     *
     * @return $postList
     */
    public function searchPostList($title)
    {
        if (Session::get('LOGIN_USER')->type == 0) {
            $postQuery = Post::leftjoin('users', function ($leftjoin) {
                $leftjoin->on('posts.create_user_id', '=', 'users.id');
            });
            $postQuery->select('posts.*', 'users.name', 'users.type');
            if ($title) {
                $postQuery->where('title', 'like', '%' . $title . '%');
            }
            return $postQuery->paginate(config('constant.PAGINATION_RECORDS'));
        } else {
            $postQuery = Post::leftjoin('users', function ($leftjoin) {
                $leftjoin->on('posts.create_user_id', '=', 'users.id');
            });
            $postQuery->select('posts.*', 'users.name', 'users.type');
            $postQuery->whereNotIn('posts.id', function ($q) {
                $q->select('id')
                    ->where('status', '=',  0)
                    ->where('create_user_id', '<>',  Session::get('LOGIN_USER')->id)
                    ->from('posts');
            });
            if ($title) {
                $postQuery->where('title', 'like', '%' . $title . '%');
            }
            return $postQuery->paginate(config('constant.PAGINATION_RECORDS'));
        }
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
