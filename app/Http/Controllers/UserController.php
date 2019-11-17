<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection as UserCollection;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

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

    /**
     * Get all Users
     *
     * @return JsonResource
     */
    public function index()
    {
        return new UserCollection(User::with('role', 'teams')->get());
    }

    /**
     * Create new User
     *
     * @param Request $request
     * @return User
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            $user->update($request->all());
            $user->save();
//            if ($request->teams) {
//                $user->teams()->sync($request->teams);
//            }
            if ($request->role) {
                $user->role()->associate(Role::findOrFail($request->role));
            }
            return response()->json($user->refresh(), 200);
        } catch (Exception $exception) {
            return response()->json($exception, 400);
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::with('role', 'teams')->findOrFail($id);
        $user->update($request->all());
        if ($request->teams) {
            $user->teams()->sync($request->teams);
        }
        if ($request->role) {
            $user->role()->associate(Role::findOrFail($request->role));
        }
        $user->save();
        return response()->json($user->refresh(), 200);
    }

    /**
     * Delete one User
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = User::findOrFail($id);
        if (!$res) {
            return response()->json('Couldn\'t delete user');
        }
        return response()->json($res->delete(), 200);
    }
}
