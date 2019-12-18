<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    //get post list
    public function getPostList();

    //update post
    public function updatePost($request, $id);
}
