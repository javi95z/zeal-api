<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'bio' => $faker->realText,
        'discount' => $faker->randomFloat(2, 0, 99),
        'name' => $faker->name,
        'website' => $faker->url,
        'phone_number' => $faker->e164PhoneNumber,
        'mobile_phone' => $faker->e164PhoneNumber
    ];
});
