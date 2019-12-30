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
     * Search user list
     *
     * @return $userList
     */
    public function searchUserList($name, $email, $from, $to)
    {
        Log::info('In Dao');
        Log::info($name);
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

        return $usersQuery->paginate(10);
    }

    // $usersQuery = Users::query();

    // $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
    // $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

    // if($start_date &amp;&amp; $end_date){

    //  $start_date = date('Y-m-d', strtotime($start_date));
    //  $end_date = date('Y-m-d', strtotime($end_date));

    //  $usersQuery->whereRaw("date(users.created_at) >= '" . $start_date . "' AND date(users.created_at) <= '" . $end_date . "'");
    // }
    // $users = $usersQuery->select('*');
    // return datatables()->of($users)
    //     ->make(true);

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
