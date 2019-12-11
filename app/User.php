<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'type',
        'phone',
        'address',
        'dob',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $hidden = [
        'password',
    ];
}
