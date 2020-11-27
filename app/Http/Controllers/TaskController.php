<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection as TaskCollection;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
        $this->middleware('admin');
    }

    /**
     * Get all Tasks
     *
     * @return TaskCollection
     */
    public function index()
    {
        return new TaskCollection(Task::all());
    }

    /**
     * Get one Task
     *
     * @param $id
     * @return TaskResource
     */
    public function show($id)
    {
        return new TaskResource(Task::with('comments')->findOrFail($id));
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
