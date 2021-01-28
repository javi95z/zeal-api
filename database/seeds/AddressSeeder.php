<?php

use App\Models\Contact;
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
        factory(App\Models\Address::class, 60)
            ->create()
            ->each(function (App\Models\Address $address) {
                // Add a random contact to each address
                $contact = Contact::inRandomOrder()->first();
                $address->contact()->associate($contact)->save();
            });
    }
}
