<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\ActivityLog;

class TaskObserver
{
    /**
     * Handle the tasl "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $task->id;
            $log->item_type = 'tasks';
            $log->description = 'created';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $task->id;
            $log->item_type = 'tasks';
            $log->description = 'updated';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Project  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $task->id;
            $log->item_type = 'tasks';
            $log->description = 'deleted';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
