<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LogController extends BaseController
{
    /**
     * Get activity logs for one user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $projects = Project::whereHas('users', function (Builder $query) use ($id) {
            $query->where('id', $id);
        })->get()->pluck('id');
        $tasks = Task::whereIn('project_id', $projects)->get()->pluck('id');

        $res = ActivityLog::orWhere(function ($query) use ($projects) {
            $query->where('item_type', 'projects')
                ->whereIn('item_id', $projects);
        })->orWhere(function ($query) use ($tasks) {
            $query->where('item_type', 'tasks')
                ->whereIn('item_id', $tasks);
        })->orWhere('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->when($request->input('amount'), function ($query) use ($request) {
                $query->take($request->amount);
            })
            ->get();

        // Attach resource name for each entry
        $res->each(function ($item) {
            $item->item_name = DB::table($item->item_type)->find($item->item_id)->name;
            $item->user = ($item->user_id) ? DB::table('users')->find($item->user_id, ['id', 'name', 'profile_img']) : null;
        });
        return new ResourceCollection($res);
    }
}
