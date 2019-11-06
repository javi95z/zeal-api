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
//        $user->active = $request->active;
//        $user->background_img = $request->background_img;
//        $user->email = $request->email;
//        $user->first_name = $request->first_name;
//        $user->gender = $request->gender;
//        $user->is_admin = $request->is_admin;
//        $user->last_name = $request->last_name;
//        $user->profile_img = $request->profile_img;
//        $user->suffix = $request->suffix;
        $user->teams()->sync($request->teams);
        $user->update(json_decode($request->getContent(), true));
        $user->save();
        $user->role()->associate(Role::findOrFail($request->role['id']));
        return response()->json($user, 200);
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
