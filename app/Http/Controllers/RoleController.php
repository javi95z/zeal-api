<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\Role as RoleResource;

/**
 * Class RoleController
 * @package App\Http\Controllers
 *
 * @group Roles
 */
class RoleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->ruleNames = 'validation.roles';
    }

    /**
     * Get all Roles
     *
     * @return Role[]
     */
    public function index()
    {
        return new RoleCollection(Role::all());
    }

    /**
     * Create new Role.
     *
     * @param Request $request
     * @return RoleResource
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        try {
            $role = new Role;
            if ($request->has('name')) $role->name = $request->name;
            if ($request->has('description')) $role->description = $request->description;
            if ($request->has('color')) $role->color = $request->color;
            $role->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new RoleResource($role->fresh()->refresh());
    }

    /**
     * Get one Role
     *
     * @param int $id
     * @return RoleResource
     */
    public function show($id)
    {
        return new RoleResource(Role::findOrFail($id));
    }

    /**
     * Update one Role
     *
     * @param Request $request
     * @param int $id
     * @return RoleResource
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validation($request);
        if ($validator !== true) return response()->json($validator, 400);
        $role = Role::findOrFail($id);
        try {
            if ($request->has('name')) $role->name = $request->name;
            if ($request->has('description')) $role->description = $request->description;
            if ($request->has('color')) $role->color = $request->color;
            $role->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new RoleResource($role->refresh());
    }

    /**
     * Delete one Role
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Role::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete role']);
        return response()->json(true, 200);
    }
}
