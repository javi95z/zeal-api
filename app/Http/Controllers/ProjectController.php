<?php

namespace App\Http\Controllers;

use App\Project;
use App\Contact;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\Project as ProjectResource;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 *
 * @group Projects
 */
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), config('validation.projects'));
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    /**
     * Get all Projects
     *
     * @return ProjectCollection
     */
    public function index()
    {
        return new ProjectCollection(Project::with('contact', 'users')->get());
    }

    /**
     * Create new Project
     *
     * @param Request $request
     * @return ProjectResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $project = new Project;
            if ($request->has('name')) $project->name = $request->name;
            if ($request->has('code')) $project->code = $request->code;
            if ($request->has('description')) $project->description = $request->description;
            if ($request->has('status')) $project->status = $request->status;
            if ($request->has('priority')) $project->priority = $request->priority;
            if ($request->has('start_date')) $project->start_date = $request->start_date;
            if ($request->has('end_date')) $project->end_date = $request->end_date;
            $project->save();
            if ($request->has('users')) $project->users()->attach($request->get('users'));
            if ($request->has('contact')) $project->contact()->associate(Contact::findOrFail($request->contact));
            $project->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new ProjectResource($project->fresh(['contact', 'users'])->refresh());
    }

    /**
     * Get one Project
     *
     * @param $id
     * @return ProjectResource
     */
    public function show($id)
    {
        return new ProjectResource(Project::with('contact', 'users', 'tasks')->findOrFail($id));
    }

    /**
     * Update one Project
     *
     * @param Request $request
     * @param $id
     * @return ProjectResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $project = Project::with('contact', 'users', 'tasks')->findOrFail($id);
        try {
            if ($request->has('name')) $project->name = $request->name;
            if ($request->has('code')) $project->code = $request->code;
            if ($request->has('description')) $project->description = $request->description;
            if ($request->has('status')) $project->status = $request->status;
            if ($request->has('priority')) $project->priority = $request->priority;
            if ($request->has('start_date')) $project->start_date = $request->start_date;
            if ($request->has('end_date')) $project->end_date = $request->end_date;
            if ($request->has('users')) $project->users()->sync($request->users);
            if ($request->has('contact')) $project->contact()->associate(Contact::findOrFail($request->contact));
            $project->save();
        }  catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new ProjectResource($project->refresh());
    }

    /**
     * Delete one Project
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = Project::findOrFail($id);
        if (!$res->delete()) {
            return response()->json(['error' => 'Couldn\'t delete project']);
        }
        return response()->json(true, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return ProjectResource
     */
    public function removemember(Request $request, $id)
    {
        $project = Project::with('contact', 'users', 'comments.user', 'tasks')->findOrFail($id);
        $project->users()->detach($request->get('users'));
        return new ProjectResource($project->refresh());
    }

    /**
     * @param Request $request
     * @param $id
     * @return ProjectResource
     */
    public function addmember(Request $request, $id)
    {
        $project = Project::with('contact', 'users', 'comments.user', 'tasks')->findOrFail($id);
        $project->users()->attach($request->get('users'));
        return new ProjectResource($project->refresh());
    }

    /**
     * @param Request $request
     * @param $id
     * @return ProjectResource
     */
    public function addtask(Request $request, $id)
    {
        try {
            $project = Project::with('contact', 'users', 'comments.user', 'tasks')->findOrFail($id);
            $user = User::findOrFail(auth()->id());            
            $task = Task::create($request->get('task'));
            $task->user()->associate($user);
            $project->tasks()->save($task);
            $project->save();
            return new ProjectResource($project->refresh());
        } catch (\Exception $ex) {
            return response()->json($ex, 400);
        }
    }
}
