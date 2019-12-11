<?php

namespace App\Contracts\Dao\Auth;

interface LoginDaoInterface
{
    public function getManageUser($email);
    // public function saveLoginHis($email, $ip, $result);
}
