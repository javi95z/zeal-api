<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'description' => $faker->paragraph,
        'color' => $faker->hexcolor
    ];
});
