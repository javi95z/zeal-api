<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection as TaskCollection;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * @param $id
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
