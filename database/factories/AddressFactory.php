<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'line_1' => $faker->streetAddress,
        'line_2' => ($faker->boolean) ? $faker->secondaryAddress : null,
        'state' => $faker->state,
        'city' => $faker->city,
        'country' => $faker->country,
        'zipcode' => $faker->postcode
    ];
});
