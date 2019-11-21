<?php

namespace App\Http\Controllers;

use App\Project;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectCollection;

class ProjectController extends Controller
{
    /**
     * @return Project[]
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
     * @return Project
     */
    public function show($id)
    {
        return Project::with('contact', 'users', 'comments.user', 'users', 'tasks')->findOrFail($id);
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
}
