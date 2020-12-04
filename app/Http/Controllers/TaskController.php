<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection as TaskCollection;
use App\Http\Resources\Task as TaskResource;

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
    
    /**
     * Get all Tasks
     *
     * @return TaskCollection
     */
    public function index()
    {
        return new TaskCollection(Task::with('project:id,name', 'user:id,suffix,last_name,first_name')->get());
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
