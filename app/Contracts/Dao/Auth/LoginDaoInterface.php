<?php

namespace App\Contracts\Dao\Auth;

interface LoginDaoInterface
{
    //get manage user by email
    public function getManageUser($email);
}
