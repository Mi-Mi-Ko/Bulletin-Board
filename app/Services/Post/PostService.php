<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Post;
use Session;

class PostService implements PostServiceInterface
{
    /**
     * Private variable $postDao
     *
     */
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
     * search
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function searchPostList($request)
    {
        $result = $this->postDao->searchPostList($request["title"]);
        return $result;
    }

    /**
     * store post
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function storePost($request)
    {
        $request["create_user_id"] = Session::get('LOGIN_USER')->id;
        $request["updated_user_id"] = Session::get('LOGIN_USER')->id;
        $request["created_at"] = date('Y-m-d H:i:s');
        $result = $this->postDao->storePost($request);
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
     * @param $id
     * @return void
     */
    public function deletePost($id)
    {
        $result = $this->postDao->deletePost($id);
    }

    /**
     * store post import file
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function importPost($data)
    {

        if ($data->count() > 0) {
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    $insert_data[] = array(
                        'Title' => $row['title'],
                        'Description' => $row['description'],
                        'CreatedUserId' => Session::get('LOGIN_USER')->id,
                        'UpdatedUserId' => Session::get('LOGIN_USER')->id,
                        'CreatedAt' => date('Y-m-d H:i:s'),
                    );
                }
            }
            // if (!empty($insert_data)) {
            //     $result = $this->postDao->importPost($insert_data);
            //     return $result;
            // }
        }

    }
}
