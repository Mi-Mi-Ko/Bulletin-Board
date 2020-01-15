<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'profile' => "profile",
        'phone' => "09421635742",
        'address' => $faker->address,
        'dob' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')
            ->format('Y-m-d'), // outputs as 2001/09/21
        'create_user_id' => "1",
        'updated_user_id' => "1",
        'deleted_user_id' => "1",
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
        'deleted_at' => date("Y-m-d H:i:s"),
    ];
});
