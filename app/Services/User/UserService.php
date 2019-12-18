<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use Log;

class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Constructor
     *
     * @param UserDaoInterface $userDao
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * login
     *
     * @param Request $request
     * @return obj [OR] null
     */
    public function getUserList()
    {
        $result = $this->userDao->getUserList();
        Log::info('User Service');
        Log::info($result);
        return $result;
    }
}
