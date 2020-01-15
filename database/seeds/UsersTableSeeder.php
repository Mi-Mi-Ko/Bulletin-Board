<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                [
                    'name' => "Mi Mi Ko",
                    'email' => "scm.mimiko@gmail.com",
                    'password' => bcrypt('12345678A'),
                    'profile' => "aaa",
                    'type' => "0",
                    'phone' => "09421632561",
                    'address' => "Toungoo",
                    'dob' => "1993-12-01",
                    'create_user_id' => "1",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "Phyu Sin",
                    'email' => "phyusin@gmail.com",
                    'password' => bcrypt('12345678A'),
                    'profile' => "aaa",
                    'type' => "0",
                    'phone' => "09421632561",
                    'address' => "Toungoo",
                    'dob' => "1993-12-01",
                    'create_user_id' => "1",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "田中",
                    'email' => "tanaka@gmail.com",
                    'password' => bcrypt('12345678A'),
                    'profile' => "aaa",
                    'type' => "1",
                    'phone' => "09421632568",
                    'address' => "ヤンゴン",
                    'dob' => "1993-06-01",
                    'create_user_id' => "2",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );
    }
}
