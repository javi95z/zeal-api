<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TaskReport;
use Faker\Generator as Faker;

$factory->define(TaskReport::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\User::inRandomOrder()->first()->id;
        },
        'invested_hours' => rand(2, 8),
        'comment' => $faker->paragraph,
    ];
});
