<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Project::class, 25)
            ->create()
            ->each(function (App\Models\Project $project) {
                // Add a contact and users to each project
                $contact = Contact::inRandomOrder()->first();
                $project->contact()->associate($contact)->save();
                $users = User::inRandomOrder()->limit(5)->get();
                $project->users()->attach($users);
            });
    }
}
