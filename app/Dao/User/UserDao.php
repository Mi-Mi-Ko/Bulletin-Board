<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;

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
