<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    //get post list
    public function getPostList();

    //store post
    public function storePost($request);

    //get post by id
    public function getPostById($id);

    //update post
    public function updatePost($request, $id);

    //delete post
    public function deletePost($id);
}
