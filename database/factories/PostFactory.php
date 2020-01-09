<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'status' => '0',
        'create_user_id' => "2",
        'updated_user_id' => "2",
    ];
});
