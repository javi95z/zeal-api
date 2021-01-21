<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CurrenciesSeeder::class,
            LanguagesSeeder::class,
            RolesSeeder::class,
            TeamsSeeder::class,
            UsersSeeder::class,
            AccountsSeeder::class,
            ContactsSeeder::class,
            GroupsSeeder::class,
            AddressSeeder::class,
            ProjectsSeeder::class,
            TasksSeeder::class
        ]);
    }
}
