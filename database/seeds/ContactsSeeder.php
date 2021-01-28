<?php

use App\Models\Account;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Contact::class, 50)
            ->create()
            ->each(function (App\Models\Contact $contact) {
                // Add a random account and business type to each contact
                $account = Account::inRandomOrder()->first();
                $contact->account()->associate($account)->save();
            });
    }
}
