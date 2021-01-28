<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Account;
use Faker\Generator as Faker;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'account_number' => $faker->creditCardNumber,
        'cc_type' => $faker->creditCardType,
        'iban' => $faker->iban(),
        'country_code' => $faker->countryCode
    ];
});
