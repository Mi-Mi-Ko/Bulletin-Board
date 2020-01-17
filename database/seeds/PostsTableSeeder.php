<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert(
            [
                [
                    'title' => 'What is Laravel',
                    'description' => 'Laravel is a PHP framework...',
                    'status' => '1',
                    'create_user_id' => "3",
                    'updated_user_id' => "3",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'title' => 'What is PHP',
                    'description' => 'PHP is a server side script language...',
                    'status' => '0',
                    'create_user_id' => "3",
                    'updated_user_id' => "3",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'title' => 'What is Java',
                    'description' => 'Java is a ...',
                    'status' => '1',
                    'create_user_id' => "3",
                    'updated_user_id' => "3",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'title' => 'What is Laravel1',
                    'description' => 'Laravel is a PHP framework1...',
                    'status' => '1',
                    'create_user_id' => "4",
                    'updated_user_id' => "4",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'title' => 'What is PHP1',
                    'description' => 'PHP is a server side script language1...',
                    'status' => '0',
                    'create_user_id' => "4",
                    'updated_user_id' => "4",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'title' => 'What is Java2',
                    'description' => 'Java is a2 ...',
                    'status' => '1',
                    'create_user_id' => "4",
                    'updated_user_id' => "4",
                    'created_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );
    }
}
