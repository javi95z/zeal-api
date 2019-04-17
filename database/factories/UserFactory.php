<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,       
        'active' => $faker->boolean,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'suffix' => $faker->title,
        'gender' => Arr::random(['male', 'female']),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'is_admin' => $faker->boolean
    ];
});
