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
    /**
     * fdjfeojpeoijdes
     */
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
     * Show login form
     *
     * @return void
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Login
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $validator = $this->validateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $result = $this->loginService->login($request);
        if (is_string($result)) {
            return redirect()->back()->withInput()->withErrors(['error_msg' => $result]);
        }
        Session::put('LOGIN_USER', $result);
        return redirect('/users');
    }

    /**
     * Validate login request
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
