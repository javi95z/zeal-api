<?php

use Illuminate\Database\Seeder;
use App\Task;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Project::class, 25)
            ->create()
            ->each(function (App\Project $project) {
                // Add a contact and users to each project
                $contact = App\Contact::inRandomOrder()->first();
                $project->contact()->associate($contact)->save();
                $users = App\User::inRandomOrder()->limit(5)->get();
                $project->users()->attach($users);
            });
    }
}
