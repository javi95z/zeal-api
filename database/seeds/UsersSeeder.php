<?php

use Illuminate\Database\Seeder;
use App\User;
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
            $user = new User;
            $user->email = $faker->email;
            $user->active = $faker->boolean;
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->suffix = $faker->title;
            $user->gender = Arr::random(['male', 'female']);
            $user->password = $faker->password;
            $user->is_admin = $faker->boolean;
            $user->save();
        }
    }
}
