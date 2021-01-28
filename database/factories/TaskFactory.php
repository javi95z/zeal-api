<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $endDate = $faker->dateTimeBetween('2020-01-01', '2023-01-01');
    return [
        'name' => $faker->sentence,
        'user_id' => function () {
            return App\Models\User::inRandomOrder()->first()->id;
        },
        'description' => $faker->text(500),
        'estimated_hours' => $faker->numberBetween(4, 16),
        'status' => Arr::random(['open', 'completed', 'canceled']),
        'priority' => Arr::random(['low', 'medium', 'high']),
        'start_date' => $faker->dateTimeBetween('2018-01-01', $endDate),
        'end_date' => $endDate
    ];
});
