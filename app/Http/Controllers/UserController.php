<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection as UserCollection;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 * @package App\Http\Controllers
 *
 * @group Users
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), config('validation.users'));
        if($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }

    /**
     * Get all Users
     *
     * @return UserCollection
     */
    public function index()
    {
        return new UserCollection(User::with('role', 'teams')->get());
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
            if ($request->has('first_name')) $user->first_name = $request->first_name;
            if ($request->has('last_name')) $user->last_name = $request->last_name;
            if ($request->has('suffix')) $user->suffix = $request->suffix;
            if ($request->has('gender')) $user->gender = $request->gender;
            if ($request->has('profile_img')) $user->profile_img = $request->profile_img;
            if ($request->has('background_img')) $user->background_img = $request->background_img;
            if ($request->has('is_admin')) $user->is_admin = $request->is_admin;
            $user->save();
            if ($request->has('teams')) $user->teams()->attach($request->get('teams'));
            if ($request->has('role')) $user->role()->associate(Role::findOrFail($request->role));
            $user->push();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new UserResource($user->fresh(['role', 'teams'])->refresh());
    }

    /**
     * Get one User
     *
     * @param $id
     * @return UserResource
     */
    public function show($id)
    {
        return new UserResource(User::with('role', 'teams')->findOrFail($id));
    }

    /**
     * Update one User
     *
     * @param Request $request
     * @param $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $user = User::with('role', 'teams')->findOrFail($id);
        try {
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('active')) $user->active = $request->active;
            if ($request->has('first_name')) $user->first_name = $request->first_name;
            if ($request->has('last_name')) $user->last_name = $request->last_name;
            if ($request->has('suffix')) $user->suffix = $request->suffix;
            if ($request->has('gender')) $user->gender = $request->gender;
            if ($request->has('profile_img')) $user->profile_img = $request->profile_img;
            if ($request->has('background_img')) $user->background_img = $request->background_img;
            if ($request->has('is_admin')) $user->is_admin = $request->is_admin;
            if ($request->has('teams')) $user->teams()->sync($request->teams);
            //            $user->teams()->attach($request->get('teams'));
            if ($request->has('role')) $user->role()->associate(Role::findOrFail($request->role));
            $user->save();
        }  catch (\Exception $ex) {
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
