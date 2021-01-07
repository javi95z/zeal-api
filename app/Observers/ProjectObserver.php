<?php

namespace App\Observers;

use App\Project;
use App\ActivityLog;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $project->id;
            $log->item_type = 'projects';
            $log->description = 'created';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $project->id;
            $log->item_type = 'projects';
            $log->description = 'updated';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the project "deleted" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        try {
            $log = new ActivityLog;
            $log->user_id = auth()->id();
            $log->item_id = $project->id;
            $log->item_type = 'projects';
            $log->description = 'deleted';
            $log->ip_address = request()->ip();
            $log->save();  // Insert the new log
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
