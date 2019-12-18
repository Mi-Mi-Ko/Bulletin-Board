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
        Log::info("Get from database in PostDao.php.");
        return Post::paginate(5);
    }

    /**
     * Update post
     *
     * @param Request $request, $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost($request, $id)
    {
        Log::info("Update Post to database in PostDao.php.");
        // Log::info($request);
        // Log::info($id);
        Post::whereId($id)->update($request);
    }
}
