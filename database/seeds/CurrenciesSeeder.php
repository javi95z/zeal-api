<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => 'Euro',
            'abbreviation' => 'EUR',
            'symbol' => '€'
        ]);
        Currency::create([
            'name' => 'American Dollar',
            'abbreviation' => 'USD',
            'symbol' => '$'
        ]);
    }
}
