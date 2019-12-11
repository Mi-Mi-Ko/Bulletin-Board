<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\Auth\LoginServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;
use Session;
use Validator;

class LoginController extends Controller
{
    private $loginService;

    /**
     * Create a new controller instance.
     *
     * @param LoginServiceInterface $loginService
     */
    public function __construct(LoginServiceInterface $loginService)
    {
        $this->loginService = $loginService;
    }
    /**
     * show login form
     *
     * @return void
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        Log::info('Calling login from controller...');
        $validator = $this->validateForm($request);
        if ($validator->fails()) {
            Log::info('Calling login from fail...');
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $result = $this->loginService->login($request);
        if (is_string($result)) {
            return redirect()->back()->withInput()->withErrors(['error_msg' => $result]);
        }
        Session::put('LOGIN_USER', $result);
        return view('users.list');
    }

    /**
     * Validate request
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        return Validator::make($request->all(), $rules);
    }
}
