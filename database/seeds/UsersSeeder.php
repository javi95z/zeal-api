<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)
            ->create()
            ->each(function ($user) {
                $role = App\Role::all()->random();
                // $user->role()->save($role);
            });
    }
}
