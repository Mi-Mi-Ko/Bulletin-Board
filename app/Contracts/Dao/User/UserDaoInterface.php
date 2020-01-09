<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
    //get user list
    public function getUserList();

    //search user list
    public function searchUserList($name, $email, $from, $to);

    //store user
    public function storeUser($request);

    //get user by $id
    public function getUserById($id);

    //update user
    public function updateUser($request, $id);

    //delete user
    public function deleteUser($id);
}
