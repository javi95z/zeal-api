<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguagesTable extends Seeder
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
    }
}
