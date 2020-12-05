<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection as TaskCollection;
use App\Http\Resources\Task as TaskResource;
use Illuminate\Support\Facades\Validator;

/**
 * Class TaskController
 * @package App\Http\Controllers
 *
 * @group Tasks
 */
class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), config('validation.tasks'));
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    /**
     * Get all Tasks
     *
     * @param $request
     * @return TaskCollection
     */
    public function index(Request $request)
    {
        // Return tasks from a specific project
        if ($request->has('project')) {
            return new TaskCollection(Task::where('project_id', $request->get('project'))->with('user:id,suffix,last_name,first_name')->get());
        }
        return new TaskCollection(Task::with('project:id,name', 'user:id,suffix,last_name,first_name')->get());
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
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {
        return new TaskResource(Task::with('project', 'user', 'comments')->findOrFail($id));
    }

    /**
     * Update one Task
     *
     * @param Request $request
     * @param $id
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
        }  catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TaskResource($task->refresh());
    }

    /**
     * Delete one Task
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = Task::findOrFail($id);
        if (!$res) {
            return response()->json('Couldn\'t delete task');
        }
        return response()->json($res->delete(), 200);
    }
}
