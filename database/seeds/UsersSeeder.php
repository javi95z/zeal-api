<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $rows = 20;
        for ($i=0; $i < $rows; $i++) {
            User::create([
                'email' => $faker->email,
                'active' => $faker->boolean,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'suffix' => $faker->title,
                'gender' => Arr::random(['male', 'female']),
                'password' => $faker->password,
                'is_admin' => $faker->boolean
            ]);
        }
    }
}
