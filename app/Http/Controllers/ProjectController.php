<?php

namespace App\Http\Controllers;

use App\Project;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\Project as ProjectResource;

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

    /**
     * @return ProjectCollection
     */
    public function index()
    {
        return new ProjectCollection(Project::with('contact', 'users')->get());
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return ProjectResource
     */
    public function show($id)
    {
        return new ProjectResource(Project::with('contact', 'users', 'comments.user', 'tasks')->findOrFail($id));
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $project = Project::with('contact', 'users')->findOrFail($id);
        $project->update($request->all());
        if ($request->users) {
            $project->users()->sync($request->users);
        }
        if ($request->contact) {
            $project->contact()->associate(Contact::findOrFail($request->contact));
        }
        $project->save();
        return response()->json($project->refresh(), 200);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function removemember(Request $request, $id)
    {
        $project = Project::with('users')->findOrFail($id);
        $project->users()->detach($request->get('users'));
        return new ProjectResource($project->refresh());
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function addmember(Request $request, $id)
    {
        $project = Project::with('users')->findOrFail($id);
        $project->users()->attach($request->get('users'));
        return new ProjectResource($project->refresh());
    }
}
