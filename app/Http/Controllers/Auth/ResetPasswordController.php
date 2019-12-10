<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    /**
     *???????????????????????????
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm()
    {
        //
        return view('auth.password.change');
    }
}
