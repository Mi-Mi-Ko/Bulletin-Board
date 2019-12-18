<?php

namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\LoginDaoInterface;
use App\User;
use Log;

class LoginDao implements LoginDaoInterface
{
    /**
     * Get manage user
     *
     * @param string $email
     * @return User
     */
    public function getManageUser($email)
    {
        Log::info('call getManageUser from LoginDao');
        return User::where('email', $email)->first();
    }
}
