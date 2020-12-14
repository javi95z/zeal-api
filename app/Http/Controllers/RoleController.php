<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleCollection;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
