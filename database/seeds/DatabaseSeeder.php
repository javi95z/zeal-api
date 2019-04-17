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
            BusinessTypesSeeder::class,
            CurrenciesSeeder::class,
            LanguagesSeeder::class,
            UsersSeeder::class
        ]);
    }
}
