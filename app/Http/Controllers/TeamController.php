<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\Team as TeamResource;
use App\Http\Controllers\BaseController;

/**
 * Class TeamController
 * @package App\Http\Controllers
 *
 * @group Teams
 */
class TeamController extends BaseController
{
    public function __construct()
    {
        $this->ruleNames = 'validation.teams';
    }

    /**
     * Get all Teams
     *
     * @return TeamCollection
     */
    public function index(Request $request)
    {
        // Return teams of a user if specified
        $user = $request->input('user');
        if ($user) return new TeamCollection(User::findOrFail($user)->teams()->with(with('users:id,name,profile_img'))->get());
        return new TeamCollection(Team::with('users:id,name,profile_img')->get());
    }

    /**
     * Create new Team
     *
     * @param  Request $request
     * @return TeamResource
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Get one Team
     *
     * @param  int  $id
     * @return TeamResource
     */
    public function show($id)
    {
        return new TeamResource(Team::with('users:id,name')->findOrFail($id));
    }

    /**
     * Update one Team
     *
     * @param Request $request
     * @param int $id
     * @return TeamResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $team = Team::with('users')->findOrFail($id);
        try {
            if ($request->has('name')) $team->name = $request->name;
            if ($request->has('description')) $team->description = $request->description;
            if ($request->has('profile_img')) $team->profile_img = $request->profile_img;
            if ($request->has('background_img')) $team->background_img = $request->background_img;
            if ($request->has('users')) $team->users()->sync($request->users);
            $team->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TeamResource($team->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
