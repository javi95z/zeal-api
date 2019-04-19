<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Address::class, 60)
            ->create()
            ->each(function (App\Address $address) {
                // Add a random contact to each address
                $contact = App\Contact::inRandomOrder()->first();
                $address->contact()->associate($contact)->save();
            });
    }
}
