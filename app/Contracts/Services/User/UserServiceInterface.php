<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
    //get user list
    public function getUserList();

    //store user
    public function storeUser($request);

    //get user by $id
    public function getUserById($id);

    //update user
    public function updateUser($request, $id);

    //delete user
    public function deleteUser($id);

    //search user list
    public function searchUserList($request);
}
