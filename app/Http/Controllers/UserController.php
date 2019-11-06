<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * @return User[]
     */
    public function index()
    {
        return User::with('role', 'teams')->get();
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
     * @return User[]
     */
    public function show($id)
    {
        return User::with('role', 'teams')->findOrFail($id);
    }

    /**
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
