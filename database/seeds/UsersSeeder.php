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
                // Add a role and a team to each user
                $role = App\Role::inRandomOrder()->first();
                $team = App\Team::inRandomOrder()->first();
                $user->role()->associate($role)->save();
                $user->teams()->attach($team);
            });
    }
}
