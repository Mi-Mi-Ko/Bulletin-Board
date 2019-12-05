<?php

use Illuminate\Database\Seeder;

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
                    'name' => "Mi Mi Ko(Designium Team)",
                    'email' => "scm.mimiko@gmail.com",
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "0",
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
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "1",
                    'create_user_id' => "1",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "Mi Mi Ko",
                    'email' => "mimiko@gmail.com",
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "0",
                    'create_user_id' => "1",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "Chaw Pyae Lwin(Designium Team)",
                    'email' => "cpl@gmail.com",
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "1",
                    'create_user_id' => "1",
                    'updated_user_id' => "1",
                    'deleted_user_id' => "1",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "May Soe(Java Team)",
                    'email' => "maysoe@gmail.com",
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "1",
                    'create_user_id' => "3",
                    'updated_user_id' => "3",
                    'deleted_user_id' => "3",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => "Mi Mi Ko(Seattle Consulting Myanmar)",
                    'email' => "mmk@gmail.com",
                    'password' => bcrypt('12345678'),
                    'profile' => "aaa",
                    'type' => "1",
                    'create_user_id' => "3",
                    'updated_user_id' => "3",
                    'deleted_user_id' => "3",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'deleted_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );
    }
}
