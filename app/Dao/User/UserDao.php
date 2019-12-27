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

        return User::paginate(10);
    }
    /**
     * Store user
     *
     * @param Request $request
     * @return void
     */
    public function storeUser($request)
    {
        Log::info('storeUser=>');
        Log::info($request);
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
