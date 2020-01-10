<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
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

    //import posts
    public function importPost($data);
}
