<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\LoginDaoInterface;
use App\Contracts\Services\Auth\LoginServiceInterface;
use Hash;
use Log;

class LoginService implements LoginServiceInterface
{
    private $loginDao;

    /**
     * Constructor
     *
     * @param LoginDaoInterface $loginDao
     */
    public function __construct(LoginDaoInterface $loginDao)
    {
        $this->loginDao = $loginDao;
    }

    /**
     * login
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function login($request)
    {

        $result = $this->loginDao->getManageUser($request->email);
        Log::info($result);
        if (!empty($result)) {
            if (Hash::check($request->password, $result->password)) {
                return $this->getLoginUser($result);
            }
            return trans('messages.login_error');
        } else {
            return trans('messages.no_exist');
        }
    }

    /**
     * create login user obj
     *
     * @param obj $user
     * @return obj
     */
    private function getLoginUser($user)
    {
        $loginUser = new \stdClass();
        $loginUser->id = $user->id;
        $loginUser->name = $user->name;
        $loginUser->email = $user->email;
        $loginUser->password = $user->password;
        $loginUser->profile = $user->profile;
        $loginUser->type = $user->type;
        $loginUser->phone = $user->phone;
        $loginUser->address = $user->address;
        $loginUser->dob = $user->dob;
        $loginUser->create_user_id = $user->create_user_id;
        return $loginUser;
    }
}
