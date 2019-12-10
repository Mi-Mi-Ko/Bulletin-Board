<?php

use Illuminate\Database\Seeder;

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
        DB::table('posts')->insert([
            'title' => 'What is Laravel',
            'description' => 'Laravel is a PHP framework',
            'status' => '1',
            'create_user_id' => "1",
            'updated_user_id' => "1",
        ]);
    }
}
