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
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        factory(App\User::class, 20)
            ->create()
            ->each(function (App\User $user) {

                // Add a random role and team to each user
                $role = App\Role::inRandomOrder()->first();
                $team = App\Team::inRandomOrder()->first();
                $user->role()->associate($role)->save();
                $user->teams()->attach($team);
            });
    }
}
