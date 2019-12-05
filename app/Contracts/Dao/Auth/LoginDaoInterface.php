<?php

namespace App\Contracts\Dao\Admin;

interface LoginDaoInterface
{
    public function getManageUser($email);
    // public function saveLoginHis($email, $ip, $result);
}
