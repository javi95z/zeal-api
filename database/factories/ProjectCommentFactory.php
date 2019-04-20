<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProjectComment;
use Faker\Generator as Faker;

$factory->define(ProjectComment::class, function (Faker $faker) {
    return [
        'comment' => $faker->text,
        'user_id' => App\User::inRandomOrder()->first()->id,
        'created_at' => $faker->dateTime('now')
    ];
});
