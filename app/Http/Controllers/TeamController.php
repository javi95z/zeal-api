<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\TeamCollection;
use App\Http\Resources\Team as TeamResource;

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
        parent::__construct();
        $this->ruleNames = 'validation.teams';
    }

    /**
     * Get all Teams
     *
     * @param Request $request
     * @return TeamCollection
     */
    public function index(Request $request)
    {
        // Filter by users if specified
        return new TeamCollection(
            Team::when($request->input('user'), function ($query) use ($request) {
                $query->whereHas('users', function (Builder $query) use ($request) {
                    $query->whereIn('id', $request->input('user'));
                });
            })->when($request->input('limit'), function ($query) use ($request) {
                $query->take($request->limit);
            })->with('users:id,name,profile_img')->get()
        );
    }

    /**
     * Create new Team
     *
     * @param Request $request
     * @return TeamResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $team = new Team;
            if ($request->has('name')) $team->name = $request->name;
            if ($request->has('description')) $team->description = $request->description;
            if ($request->has('profile_img')) $team->profile_img = $request->profile_img;
            if ($request->has('background_img')) $team->background_img = $request->background_img;
            $team->save();
            if ($request->has('users')) $team->users()->attach($request->users);
            $team->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TeamResource($team->fresh(['users:id,name,profile_img'])->refresh());
    }

    /**
     * Get one Team
     *
     * @param int $id
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
     * Delete one Team
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Team::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete team']);
        return response()->json(true, 200);
    }
}
