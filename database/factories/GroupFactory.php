<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->domainWord) . ' Group',
        'description' => $faker->text,
        'discount' => $faker->randomFloat(2, 0, 99)
    ];
});
