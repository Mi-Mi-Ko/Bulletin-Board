<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\User;
use File;
use Illuminate\Http\Request;
use Log;
use Redirect;
use Response;
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

    /**
     * Display a listing of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = $this->validateForm($request);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $data['users'] = $request;
        return view('users.confirm', $data);
    }

    /**
     * Validate user request
     *
     * @param Request $request
     * @return void
     */
    private function validateForm(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            'profile' => 'required',
            'type' => 'required',
            'dob' => 'required|date_format:Y/m/d',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * Store
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Log::info('Calling store in controller...');
        Log::info($request->file('profile'));

        if ($files = $request->file('profile')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }
        // $show = User::create($validatedData);
        return redirect('/users')->with('success', 'User is successfully saved');
    }

    /**
     * Show user update view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $users = User::findOrFail($id);
        return view('users.update', compact('users'));
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
        return view('users.list');
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
        $users = User::findOrFail($id);
        return view('users.profile', compact('users'));
    }
}
