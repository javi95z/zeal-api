<?php

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
        factory(App\Contact::class, 50)
            ->create()
            ->each(function (App\Contact $contact) {
                // Add a random account and business type to each contact
                $account = App\Account::inRandomOrder()->first();
                $bt = App\BusinessType::inRandomOrder()->first();
                $contact->account()->associate($account)->save();
                $contact->businessType()->associate($bt)->save();
            });
    }
}
