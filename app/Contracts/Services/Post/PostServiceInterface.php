<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    //get post list
    public function getPostList();

    //search post list
    public function searchPostList($request);

    //store post
    public function storePost($request);

    //get post by id
    public function getPostById($id);

    //update post
    public function updatePost($request, $id);

    //delete post
    public function deletePost($id);
}
