<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = new Task;
        $task->title = 'Setting up the server';
        $task->description = 'Set up a home server running an open-source operating system in order to run the website.';
        $task->status = 'completed';
        $task->start_date = '2018-02-10';
        $task->end_date = '2018-03-01';
        $task->project()->associate(1);
        $task->save();

        $task = new Task;
        $task->title = 'Buying a domain name';
        $task->description = 'Choose and register the right domain name.';
        $task->status = 'inprogress';
        $task->start_date = '2018-02-21';
        $task->end_date = '2018-03-18';
        $task->project()->associate(1);
        $task->save();

        $task = new Task;
        $task->title = 'Setting up the server';
        $task->description = 'Set up a home server running an open-source operating system in order to run the website.';
        $task->status = 'completed';
        $task->start_date = '2018-02-10';
        $task->end_date = '2018-03-01';
        $task->project()->associate(2);
        $task->save();
    }
}
