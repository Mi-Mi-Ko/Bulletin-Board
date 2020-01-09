<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Log;

class UserDao implements UserDaoInterface
{
    /**
     * Get user list
     *
     * @return $userList
     */
    public function getUserList()
    {

        return User::paginate(config('constant.PAGINATION_RECORDS'));
    }
    /**
     * Search user list
     *
     * @return $userList
     */
    public function searchUserList($name, $email, $from, $to)
    {
        Log::info('In Dao');
        $usersQuery = User::query();
        if ($name) {
            $usersQuery->where('name', 'like', '%' . $name . '%');
        }
        if ($email) {
            $usersQuery->where('email', $email);
        }
        if ($from && $to) {
            $usersQuery->whereBetween('created_at', [$from, $to]);
        }

        return $usersQuery->paginate(config('constant.PAGINATION_RECORDS'));
    }
    /**
     * Store user
     *
     * @param Request $request
     * @return void
     */
    public function storeUser($request)
    {
        return User::create($request);
    }
    /**
     * Get User by id
     *
     * @return $user
     */
    public function getUserById($id)
    {
        Log::info("getUserById in UserDao.php.");
        return User::findOrFail($id);
    }
    /**
     * Update user
     *
     * @param Request $request, $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $id)
    {
        Log::info('In Dao Request Data====>');
        Log::info($request);
        User::whereId($id)->update($request);
    }
    /**
     * Delete post
     *
     * @param Request $request
     * @return void
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
