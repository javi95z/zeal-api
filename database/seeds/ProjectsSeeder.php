<?php

use Illuminate\Database\Seeder;
use App\ProjectComment;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Project::class, 15)
            ->create()
            ->each(function (App\Project $project) {
                // Add a contact and some users and comments to each project
                $contact = App\Contact::inRandomOrder()->first();
                $project->contact()->associate($contact)->save();
                $users = App\User::inRandomOrder()->limit(5)->get();
                $project->users()->attach($users);
                $numComments = rand(0, 8);
                $project->comments()->saveMany(factory(ProjectComment::class, $numComments)->make());
            });
    }
}
