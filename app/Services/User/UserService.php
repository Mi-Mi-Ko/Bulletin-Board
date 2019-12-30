<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Log;
use Session;

class UserService implements UserServiceInterface
{
    /**
     * Private variable $userDao
     *
     */
    private $userDao;
    /**
     * Constructor
     *
     * @param UserDaoInterface $userDao
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }
    /**
     * login
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function getUserList()
    {
        $result = $this->userDao->getUserList();
        return $result;
    }
    /**
     * search
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function searchUserList($request)
    {
        Log::info("In service");
        $result = $this->userDao->searchUserList($request["name"], $request["email"], $request["from"], $request["to"]);
        return $result;
    }
    /**
     * store user
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function storeUser($request)
    {
        $request["create_user_id"] = Session::get('LOGIN_USER')->id;
        $request["updated_user_id"] = Session::get('LOGIN_USER')->id;
        $request["created_at"] = date('Y-m-d H:i:s');
        $result = $this->userDao->storeUser($request);
        return $result;
    }
    /**
     * get user by id
     *
     * @param Request $id
     * @return obj
     */
    public function getUserById($id)
    {
        Log::info('gey User by id');
        $result = $this->userDao->getUserById($id);
        return $result;
    }
    /**
     * update user
     *
     * @param Request $request, $id
     * @return obj [OR] null
     */
    public function updateUser($request, $id)
    {
        $request["updated_user_id"] = Session::get('LOGIN_USER')->id;
        $request["updated_at"] = date('Y-m-d H:i:s');
        $result = $this->userDao->updateUser($request, $id);
        return $result;
    }
    /**
     * delete user
     *
     * @param $id
     * @return void
     */
    public function deleteUser($id)
    {
        $result = $this->userDao->deleteUser($id);
    }
}
