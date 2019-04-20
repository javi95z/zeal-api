<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Project;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $maxDate = $faker->date();
    return [
        'name' => $faker->sentence,
        'code' => 'PR' . $faker->randomNumber(4),
        'description' => $faker->text(500),
        'status' => Arr::random(['open', 'completed', 'canceled']),
        'priority' => Arr::random(['low', 'medium', 'high']),
        'start_date' => $faker->date('Y-m-d', $maxDate),
        'end_date' => $maxDate
    ];
});
