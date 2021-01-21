<?php

use App\TaskReport;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Task::class, 100)
            ->create()
            ->each(function (App\Task $task) {
                // Attach the task to a project and create reports for it
                $project = App\Project::inRandomOrder()->first();
                $task->project()->associate($project)->save();
                $num = rand(2, 8);
                $task->reports()->saveMany(factory(TaskReport::class, $num)->make());
            });
    }
}
