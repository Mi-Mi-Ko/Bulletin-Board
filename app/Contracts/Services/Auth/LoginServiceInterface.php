<?php

namespace App\Contracts\Services\Auth;

interface LoginServiceInterface
{
    // login
    public function login($request);

    //change password
    public function changePassword($request);
}
