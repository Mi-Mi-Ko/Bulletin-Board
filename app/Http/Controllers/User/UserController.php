<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Redirect;
use Response;
use Session;
use Storage;
use Validator;

class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param EventServiceInterface $eventService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function getUserService()
    {
        return $userService;
    }
    public function setUserService($service)
    {
        $userService = $service;
    }
    /**
     * Display a listing of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //getenv('LOCALE')
        $users = $this->userService->getUserList();
        Log::info('Return Data::');
        return view('users.list', compact('users'));
    }

    /**
     * Show user creating view
     *
     * @param  int
     * @return
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Validation and go to user confirmation form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function confirmation(Request $request)
    {
        Log::info($request);
        $validator = $this->validateInputForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if ($files = $request->file('profile')) {
            $userId = Session::get('LOGIN_USER')->id;
            $isExit = File::exists(public_path() . "/images/$userId");
            if (!$isExit) {
                Storage::makeDirectory(public_path() . "/images/$userId");
            }
            $image = $request->profile->store("public/images/$userId");
            $imageName = $request->profile->getClientOriginalName();
            $request->profile->move(public_path("images/$userId"), $imageName);
        }
        $data['user'] = $request;
        return view('users.confirm', $data);
    }
    /**
     * Store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $this->userService->storeUser($request->except('_token'));

        return redirect('/users')->with('success', 'ユーザーを登録しました。');
    }

    /**
     * Show user update view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.update', compact('user'));
    }

    /**
     * Show user update confirmation view
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConfirmation(Request $request, $id)
    {
        $validator = $this->validateUpdateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['user'] = $request;
        return view('users.updateConfirm', $data);
    }

    /**
     * Update user resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function update(Request $request, $id)
    {
        Log::info('Calling user update');
        Log::info($request);
        $this->userService->updateUser($request->except('_token'), $id);
        return redirect('/users')->with('success', 'ユーザーを更新しました。');
    }

    /**
     * Delete user resources
     *
     * @param  int  $id
     * @return
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Display user profile view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        //
        $user = User::findOrFail($id);
        return view('users.profile', compact('user'));
    }
    /**
     * Validate user request
     *
     * @param Request $request
     * @return void
     */
    private function validateInputForm(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'profile' => 'required',
            'type' => 'required',
            'dob' => 'required|date_format:Y/m/d',
        ];
        return Validator::make($request->all(), $rules);
    }

    private function validateUpdateForm(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users,name,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'type' => 'required',
            'dob' => 'required|date_format:Y/m/d',
        ];
        return Validator::make($request->all(), $rules);
    }
}
