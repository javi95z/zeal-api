<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'active' => $faker->boolean,
        'name' => $faker->firstName . " " . $faker->lastName,
        'suffix' => $faker->title,
        'gender' => Arr::random(['male', 'female']),
        'password' => bcrypt('password'),
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
        'profile_img' => "https://randomuser.me/api/portraits/" . Arr::random(['men', 'women']) . "/" . $faker->randomFloat(0, 0, 80) . ".jpg",
        'is_admin' => $faker->boolean
    ];
});
