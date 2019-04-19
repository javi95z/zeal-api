<?php

use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Account::class, 20)
            ->create()
            ->each(function (App\Account $account) {
                // Add a random currency to each account
                $currency = App\Currency::inRandomOrder()->first();
                $account->currency()->associate($currency)->save();
            });
    }
}
