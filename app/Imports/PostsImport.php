<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class PostsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Post([
            'title' => $row['title'],
            'description' => $row['description'],
            'create_user_id' => Session::get('LOGIN_USER')->id,
            'updated_user_id' => Session::get('LOGIN_USER')->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
