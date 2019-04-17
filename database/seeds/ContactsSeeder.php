<?php

use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user->website = $faker->domainName;
        $user->city = $faker->city;
        $user->country = $faker->country;
        $user->phone_number = $faker->phoneNumber;
    }
}
