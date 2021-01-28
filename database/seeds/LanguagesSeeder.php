<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'abbreviation' => 'en'
        ]);
        Language::create([
            'name' => 'Spanish',
            'abbreviation' => 'es'
        ]);
        Language::create([
            'name' => 'French',
            'abbreviation' => 'fr'
        ]);
    }
}
