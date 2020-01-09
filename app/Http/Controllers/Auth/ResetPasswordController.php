<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\Auth\LoginServiceInterface;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Validator;

class ResetPasswordController extends Controller
{
    /**
     * Private variable $loginService
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
     * Show change password form
     *
     * @return \Illuminate\Http\Response
     */
    public function showChangePasswordForm()
    {
        return view('auth.password.change');
    }

    public function change(Request $request)
    {
        $validator = $this->validateInputForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $request->merge(['password' => Hash::make($request->new_password)]);
        $this->loginService->changePassword($request);
        return redirect('/users')->with('success', 'パスワードを更新しました。');
    }
    /**
     * Validate change password input form request
     *
     * @param Request $request
     * @return void
     */
    private function validateInputForm(Request $request)
    {
        $rules = [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => ['same:new_password'],
        ];
        return Validator::make($request->all(), $rules);
    }

}
