<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Log;

class PostService implements PostServiceInterface
{
    private $postDao;

    /**
     * Constructor
     *
     * @param PostDaoInterface $postDao
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * get post list
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function getPostList()
    {
        $result = $this->postDao->getPostList();
        Log::info('Post Service');
        Log::info($result);
        return $result;
    }
    /**
     * update post
     *
     * @param Request $request, $id
     * @return obj [OR] null
     */
    public function updatePost($request, $id)
    {
        $result = $this->postDao->updatePost($request, $id);
        Log::info('Post Service');
        Log::info($result);
        return $result;
    }
}
