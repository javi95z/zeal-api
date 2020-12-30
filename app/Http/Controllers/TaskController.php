<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection as TaskCollection;
use App\Http\Resources\Task as TaskResource;

/**
 * Class TaskController
 * @package App\Http\Controllers
 *
 * @group Tasks
 */
class TaskController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->ruleNames = 'validation.tasks';
    }

    /**
     * Get all Tasks
     *
     * @param Request $request
     * @return TaskCollection
     */
    public function index(Request $request)
    {
        // Filter by projects or users if specified
        return new TaskCollection(
            Task::when($request->input('project'), function ($query) use ($request) {
                $query->orWhereIn('project_id', $request->input('project'));
            })->when($request->input('user'), function ($query) use ($request) {
                $query->orWhereIn('user_id', $request->input('user'));
            })->with('project:id,name', 'user:id,suffix,name')->get()
        );
    }

    /**
     * Create new Task
     *
     * @param Request $request
     * @return TaskResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $task = new Task;
            if ($request->has('name')) $task->name = $request->name;
            if ($request->has('description')) $task->description = $request->description;
            if ($request->has('status')) $task->status = $request->status;
            if ($request->has('priority')) $task->priority = $request->priority;
            if ($request->has('start_date')) $task->start_date = $request->start_date;
            if ($request->has('end_date')) $task->end_date = $request->end_date;
            $task->save();
            if ($request->has('project')) $task->project()->associate(Project::findOrFail($request->project));
            if ($request->has('user')) $task->user()->associate(User::findOrFail($request->user));
            $task->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TaskResource($task->fresh(['project', 'user'])->refresh());
    }

    /**
     * Get one Task
     *
     * @param int $id
     * @return TaskResource
     */
    public function show($id)
    {
        return new TaskResource(Task::with('project', 'user', 'comments')->findOrFail($id));
    }

    /**
     * Update one Task
     *
     * @param Request $request
     * @param int $id
     * @return TaskResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $task = Task::with('project', 'user', 'comments')->findOrFail($id);
        try {
            if ($request->has('name')) $task->name = $request->name;
            if ($request->has('description')) $task->description = $request->description;
            if ($request->has('status')) $task->status = $request->status;
            if ($request->has('priority')) $task->priority = $request->priority;
            if ($request->has('start_date')) $task->start_date = $request->start_date;
            if ($request->has('end_date')) $task->end_date = $request->end_date;
            if ($request->has('project')) $task->project()->associate(Project::findOrFail($request->project));
            if ($request->has('user')) $task->user()->associate(User::findOrFail($request->user));
            $task->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TaskResource($task->refresh());
    }

    /**
     * Delete one Task
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = Task::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete task']);
        return response()->json(true, 200);
    }
}
