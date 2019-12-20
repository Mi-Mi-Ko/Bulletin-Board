<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Post;
use Session;

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
        return $result;
    }
    /**
     * store post
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function store($request)
    {
        $request["create_user_id"] = Session::get('LOGIN_USER')->id;
        $request["updated_user_id"] = Session::get('LOGIN_USER')->id;
        $request["created_at"] = date('Y-m-d H:i:s');
        $result = $this->postDao->store($request);
        return $result;
    }
    /**
     * get post by id
     *
     * @param Request $id
     * @return obj
     */
    public function getPostById($id)
    {
        $result = $this->postDao->getPostById($id);
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
        $request["updated_user_id"] = Session::get('LOGIN_USER')->id;
        $request["updated_at"] = date('Y-m-d H:i:s');
        $result = $this->postDao->updatePost($request, $id);
        return $result;
    }
    /**
     * delete post
     *
     * @param Request $request, $id
     * @return obj [OR] null
     */
    public function delete($id)
    {
        $result = $this->postDao->delete($id);
    }
}
