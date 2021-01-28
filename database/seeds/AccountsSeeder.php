<?php

use App\Models\Currency;
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
        factory(App\Models\Account::class, 20)
            ->create()
            ->each(function (App\Models\Account $account) {
                // Add a random currency to each account
                $currency = Currency::inRandomOrder()->first();
                $account->currency()->associate($currency)->save();
            });
    }
}
