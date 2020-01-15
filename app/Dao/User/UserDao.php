<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use DB;

class UserDao implements UserDaoInterface
{
    /**
     * Get user list
     *
     * @return $userList
     */
    public function getUserList()
    {
        // return User::paginate(config('constant.PAGINATION_RECORDS'));

        $createdUser = User::query()
            ->select('users.name', 'users.id as cId')
            ->join('users as b', function ($join) {
                $join->on('users.id', '=', 'b.create_user_id');
            });

        return User::query()
            ->joinSub($createdUser, 'created_User', function ($join) {
                $join->on('users.create_user_id', '=', 'created_User.cId');
            })
            ->groupBy('users.id')
            ->select('users.id', 'users.name', 'users.email', 'users.profile', 'created_User.name as create_user_name', 'users.phone', 'users.dob', 'users.address', 'users.created_at', 'users.updated_at')
            ->paginate(config('constant.PAGINATION_RECORDS'));
    }

    /**
     * Search user list
     *
     * @return $userList
     */
    public function searchUserList($name, $email, $from, $to)
    {
        $createdUser = User::query()
            ->select('users.name', 'users.id as cId')
            ->join('users as b', function ($join) {
                $join->on('users.id', '=', 'b.create_user_id');
            });

        $searchUser = User::query()
            ->joinSub($createdUser, 'created_User', function ($join) {
                $join->on('users.create_user_id', '=', 'created_User.cId');
            })
            ->select('users.id', 'users.name', 'users.email', 'users.profile', 'created_User.name as create_user_name', 'users.phone', 'users.dob', 'users.address', 'users.created_at', 'users.updated_at');

        if ($name) {
            $searchUser->where('users.name', 'like', '%' . $name . '%');
        }
        if ($email) {
            $searchUser->where('users.email', $email);
        }
        if ($from && $to) {
            $searchUser->whereBetween('users.created_at', [$from, $to]);
        }

        $searchUser->groupBy('users.id');

        return $searchUser->paginate(config('constant.PAGINATION_RECORDS'));
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
