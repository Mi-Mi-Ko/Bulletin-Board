<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description',
        'create_user_id',
        'updated_user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
