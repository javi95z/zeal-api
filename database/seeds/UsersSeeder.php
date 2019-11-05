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
                // Add a random role and team to each user
                $role = App\Role::inRandomOrder()->first();
                $team = App\Team::inRandomOrder()->first();
                $user->role()->associate($role)->save();
                $user->teams()->attach($team);
            });
        $admin = new App\User;
        $admin->email = 'admin@admin.com';
        $admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

        // Add a random role and team
        $role = App\Role::inRandomOrder()->first();
        $team = App\Team::inRandomOrder()->first();
        $admin->role()->associate($role)->save();
        $admin->teams()->attach($team);
        $admin->save();
    }
}
