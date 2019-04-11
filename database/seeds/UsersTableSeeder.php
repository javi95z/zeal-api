<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Arr;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
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
            $user->type = 'employee';
            $user->fullname = $faker->name;
            $user->email = $faker->email;
            $user->address = $faker->streetAddress;
            $user->password = $faker->password;
            $user->city = $faker->city;
            $user->country = $faker->country;
            $user->suffix = $faker->title;
            $user->gender = Arr::random(['male', 'female']);
            $user->phone_number = $faker->phoneNumber;
            $user->website = $faker->domainName;
            $user->profile_picture = '1mNW9BOa1uyJVAWqo2B7hAdfHFKFVGXfFO9dx9xyeQbvlLKgn4ZM9LqnYur3wsVqPU2Tgym6unysh0xkjGSxi4YAHQpflHfv25Wnw.jpg';
            $user->is_admin = $faker->boolean;
            $user->save();
            $user->positions()->attach([1, 2]);
        }
    }
}
