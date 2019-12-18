<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    //get post list
    public function getPostList();

    //update post by id
    public function updatePost($request, $id);
}
