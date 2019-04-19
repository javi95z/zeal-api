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
            ->each(function (App\User $user) {
                $role = App\Role::inRandomOrder()->first();
                $user->role()->associate($role)->save();
            });
    }
}
