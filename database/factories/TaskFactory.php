<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $maxDate = $faker->date();
    return [
        'name' => $faker->sentence,
        'user_id' => function() {
            return App\User::inRandomOrder()->first()->id;
        },
        'description' => $faker->text(500),
        'status' => Arr::random(['open', 'completed', 'canceled']),
        'priority' => Arr::random(['low', 'medium', 'high']),
        'start_date' => $faker->date('Y-m-d', $maxDate),
        'end_date' => $maxDate
    ];
});
