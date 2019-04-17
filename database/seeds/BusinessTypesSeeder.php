<?php

use App\BusinessType;
use Illuminate\Database\Seeder;

class BusinessTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessType::create([
            'name' => 'Customer',
            'name_plural' => 'Customers'
        ]);
        BusinessType::create([
            'name' => 'Supplier',
            'name_plural' => 'Suppliers'
        ]);
    }
}
