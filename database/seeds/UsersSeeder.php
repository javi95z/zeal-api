<?php

use App\Models\Role;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true
        ]);

        factory(App\Models\User::class, 20)
            ->create()
            ->each(function (App\Models\User $user) {

                // Add a random role and team to each user
                $role = Role::inRandomOrder()->first();
                $team = Team::inRandomOrder()->first();
                $user->role()->associate($role)->save();
                $user->teams()->attach($team);
            });
    }
}
