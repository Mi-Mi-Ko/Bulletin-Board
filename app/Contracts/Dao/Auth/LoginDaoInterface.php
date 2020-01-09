<?php

namespace App\Contracts\Dao\Auth;

interface LoginDaoInterface
{
    //get manage user by email
    public function getManageUser($email);

    //change password
    public function changePassword($request);
}
