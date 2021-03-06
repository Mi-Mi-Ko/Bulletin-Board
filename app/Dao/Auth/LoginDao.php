<?php

namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\LoginDaoInterface;
use App\User;
use Log;
use Session;

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
        return User::where('email', $email)->first();
    }
    /**
     * Change password
     *
     * @param string $request
     * @return void
     */
    public function changePassword($request)
    {
        Log::info("changePassword=>");
        Log::info($request);
        User::find(Session::get('LOGIN_USER')->id)->update($request);
    }

}
