<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection as UserCollection;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\App;

/**
 * Class UserController
 * @package App\Http\Controllers
 *
 * @group Users
 */
class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->ruleNames = 'validation.users';
    }

    /**
     * Get all Users
     *
     * @param Request $request
     * @return UserCollection
     */
    public function index(Request $request)
    {
        // Filter by project, team or role if specified
        return new UserCollection(
            User::when($request->input('project'), function ($query) use ($request) {
                $query->whereHas('projects', function (Builder $query) use ($request) {
                    $query->whereIn('id', $request->input('project'));
                });
            })->when($request->input('team'), function ($query) use ($request) {
                $query->whereHas('teams', function (Builder $query) use ($request) {
                    $query->whereIn('id', $request->input('team'));
                });
            })->when($request->input('role'), function ($query) use ($request) {
                $query->where('role_id', $request->input('role'));
            })->with('role', 'teams')->get()
        );
    }

    /**
     * Create new User
     *
     * @param Request $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $user = new User;
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('active')) $user->active = $request->active;
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('suffix')) $user->suffix = $request->suffix;
            if ($request->has('gender')) $user->gender = $request->gender;
            if ($request->has('profile_img')) $user->profile_img = $request->profile_img;
            if ($request->has('background_img')) $user->background_img = $request->background_img;
            if ($request->has('is_admin')) $user->is_admin = $request->is_admin;
            if ($request->has('password')) $user->password = Hash::make($request->password);
            $user->save();
            if ($request->has('teams')) $user->teams()->attach($request->get('teams'));
            if ($request->has('role')) $user->role()->associate(Role::findOrFail($request->role));
            $user->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new UserResource($user->fresh(['role', 'teams'])->refresh());
    }

    public function profileImage(Request $request, $id)
    {
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = Str::random(15) . "." . $image->extension();
            $image->move(public_path('images/profile'), $filename);
        }
        $user = User::with('role')->findOrFail($id);
        $user->profile_img = asset('images/profile/' . $filename); //$request->file('profile_image')->getClientOriginalName();
        $user->save();
        return new UserResource($user->refresh());
    }

    /**
     * Get one User
     *
     * @param int $id
     * @return UserResource
     */
    public function show($id)
    {
        return new UserResource(User::with('role', 'teams:id')->findOrFail($id));
    }

    /**
     * Update one User
     *
     * @param Request $request
     * @param int $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $user = User::with('role')->findOrFail($id);
        try {
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('active')) $user->active = $request->active;
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('suffix')) $user->suffix = $request->suffix;
            if ($request->has('gender')) $user->gender = $request->gender;
            if ($request->has('profile_img')) $user->profile_img = $request->profile_img;
            if ($request->has('background_img')) $user->background_img = $request->background_img;
            if ($request->has('is_admin')) $user->is_admin = $request->is_admin;
            if ($request->has('password')) $user->password = Hash::make($request->password);
            if ($request->has('teams')) $user->teams()->sync($request->teams);
            if ($request->has('projects')) $user->projects()->sync($request->projects);
            if ($request->has('role')) $user->role()->associate(Role::findOrFail($request->role));
            $user->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new UserResource($user->refresh());
    }

    /**
     * Delete one User
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($id == auth()->id()) return response()->json(['error' => 'Can\'t delete your own user'], 400);
        $res = User::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete user'], 400);
        return response()->json(true, 200);
    }
}
