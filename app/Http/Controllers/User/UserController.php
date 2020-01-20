<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Display a listing of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getUserList();
        return view('users.list', compact('users'));
    }

    /**
     * Display a listing of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->checkRequest($request);
        $users = $this->userService->searchUserList($request->except('_token'));
        $users->appends(request()->all())->render();
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
        $validator = $this->validateInputForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if ($request->file('profile')) {
            $userId = Session::get('LOGIN_USER')->id;
            $isExit = File::exists(public_path() . "/images/$userId");
            if (!$isExit) {
                Storage::makeDirectory(public_path() . "/images/$userId");
            }
            $imageName = $request->profile->getClientOriginalName();
            $request->profile->move(public_path("images/$userId"), $imageName);
        }
        $data['user'] = $request;
        Session::put('IMAGE', $imageName);
        Session::put('ID', $userId);
        Session::put('USER_INPUT_DATA', $request->except('profile'));
        return view('users.confirm', $data);
    }

    /**
     * back to user create page with old input
     *
     * @return void
     */
    public function backUserInput()
    {
        $userId = Session::get('ID');
        $imageName = Session::get('IMAGE');
        $oldInputData = Session::get('USER_INPUT_DATA');

        $image_path = public_path() . "/images/$userId/" . $imageName;
        unlink($image_path);

        Session::forget('USER_INPUT_DATA');
        Session::forget('IMAGE');
        Session::forget('ID');
        return redirect('/users/create')->withInput($oldInputData);
    }

    /**
     * Store user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function updateConfirmation(Request $request)
    {
        $validator = $this->validateUpdateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if ($request->file('profile')) {
            $userId = Session::get('LOGIN_USER')->id;
            $isExit = File::exists(public_path() . "/images/$userId");
            if (!$isExit) {
                Storage::makeDirectory(public_path() . "/images/$userId");
            }
            $imageName = $request->profile->getClientOriginalName();
            $request->profile->move(public_path("images/$userId"), $imageName);
        }
        $data['user'] = $request;
        Session::put('USER_UPDATE_DATA', $request->except('profile'));
        return view('users.updateConfirm', $data);
    }

    /**
     * back to user update page with old input
     *
     * @return void
     */
    public function backUserUpdate()
    {
        $oldUpdateData = Session::get('USER_UPDATE_DATA');
        Session::forget('USER_UPDATE_DATA');
        $returnRoute = '/users/' . $oldUpdateData["id"];
        return redirect($returnRoute)->withInput($oldUpdateData);
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
        $this->userService->updateUser($request->except('_token'), $id);
        return redirect('/users')->with('success', 'ユーザーを更新しました。');
    }

    /**
     * Delete user resources
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->userService->deleteUser($id);
        return redirect('/users')->with('success', 'ユーザーを削除しました。');
    }

    /**
     * Display user profile view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.profile', compact('user'));
    }

    /**
     * Validate user input form request
     *
     * @param Request $request
     * @return void
     */
    private function validateInputForm(Request $request)
    {
        $rules = [
            'name' => 'required|max:50|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'phone' => 'required|numeric|regex:/(0)[0-9]/|digits_between:8,11',
            'password' => 'required|min:8|max:25|confirmed|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'profile' => 'required|image|mimes:jpeg,jpg,png|max:1024',
            'type' => 'required',
            'dob' => 'required|after:01/01/1940|before:01/01/2011|date_format:Y/m/d',
            'address' => 'max:255',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Validate user update form request
     *
     * @param Request $request
     * @return void
     */
    private function validateUpdateForm(Request $request)
    {
        $rules = [
            'name' => 'required|max:50|unique:users,name,' . $request->id,
            'email' => 'required|email|max:50|unique:users,email,' . $request->id,
            'phone' => 'required|numeric|regex:/(0)[0-9]/|digits_between:8,11',
            'profile' => 'image|mimes:jpeg,jpg,png|max:1024',
            'type' => 'required',
            'dob' => 'required|after:01/01/1940|before:01/01/2011|date_format:Y/m/d',
            'address' => 'max:255',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Check Request key is missing
     *
     * @param Request $request
     * @return void
     */
    private function checkRequest($request)
    {
        if ($request->missing('name')) {
            $request["name"] = null;
        }
        if ($request->missing('email')) {
            $request["email"] = null;
        }
        if ($request->missing('from')) {
            $request["from"] = null;
        }
        if ($request->missing('to')) {
            $request["to"] = null;
        }
    }
}
