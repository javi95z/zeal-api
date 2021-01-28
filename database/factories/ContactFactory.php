<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Contact;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'bio' => $faker->realText,
        'discount' => $faker->randomFloat(2, 0, 99),
        'name' => $faker->name,
        'website' => "http://" . $faker->domainName,
        'phone_number' => $faker->e164PhoneNumber,
        'mobile_phone' => $faker->e164PhoneNumber,
        'type' => Arr::random(['customer', 'supplier']),
    ];
});
