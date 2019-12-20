<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    //get post list
    public function getPostList();

    //store post
    public function store($request);

    //get post by id
    public function getPostById($id);

    //update post
    public function updatePost($request, $id);

    //delete post
    public function delete($id);
}
