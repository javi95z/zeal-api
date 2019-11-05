<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

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
        'password' => bcrypt('password'),
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
        'is_admin' => $faker->boolean
    ];
});
