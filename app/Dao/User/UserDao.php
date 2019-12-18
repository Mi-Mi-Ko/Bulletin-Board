<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Log;

class UserDao implements UserDaoInterface
{
    /**
     * Get user list
     *
     * @return $userList
     */
    public function getUserList()
    {
        Log::info("Get from database in UserDao.php.");
        return User::paginate(5);
    }
}
