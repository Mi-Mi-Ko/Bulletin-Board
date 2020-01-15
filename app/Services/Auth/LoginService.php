<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\LoginDaoInterface;
use App\Contracts\Services\Auth\LoginServiceInterface;
use Illuminate\Support\Facades\Hash;

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
     * Change Password
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword($request)
    {
        $request["updated_at"] = date('Y-m-d H:i:s');
        $param = ['password' => $request->password, 'updated_at' => $request->updated_at];
        $result = $this->loginDao->changePassword($param);
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
