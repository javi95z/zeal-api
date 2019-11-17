<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers
 *
 * @group Roles
 */
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Get all Roles
     *
     * @return Role[]
     */
    public function index()
    {
        return Role::all();
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
