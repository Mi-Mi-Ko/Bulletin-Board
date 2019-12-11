<?php

namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\LoginDaoInterface;
use App\User;
use Log;

// use App\Models\MUserLoginHis;

class LoginDao implements LoginDaoInterface
{
    /**
     * Get manage_user
     *
     * @param string $email
     * @return User
     */
    public function getManageUser($email)
    {
        Log::info('call getManageUser from LoginDao');
        return User::where('email', $email)->first();
    }

    // /**
    //  * save login history
    //  *
    //  * @param int $mUserID
    //  * @param string $ip
    //  * @param int $result
    //  * @return void
    //  */
    // public function saveLoginHis($email, $ip, $result)
    // {
    //     MUserLoginHis::insert([
    //         'email' => $email,
    //         'ip' => $ip,
    //         'result' => $result,
    //         'created_at' => date('Y-m-d H:i:s'),
    //     ]);
    // }
}
