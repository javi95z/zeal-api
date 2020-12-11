<?php

/*
|--------------------------------------------------------------------------
| Validation Rules for Resources
|--------------------------------------------------------------------------
|
| This file contains the validation rules for each resource when
| it comes to storing them as a new item into the database.
|
*/

return [
    'users' => [
        'name' => 'sometimes|required|string',
        'email' => 'sometimes|required|unique:users,email|max:100',
        'active' => 'boolean',
        'suffix' => 'max:10',
        'gender' => 'in:male,female',
        'profile_img' => 'string',
        'background_img' => 'string',
        'is_admin' => 'boolean',
        'role' => 'exists:roles,id',
        'teams' => 'array|exists:teams,id'
    ],
    'projects' => [
        'name' => 'sometimes|required|string',
        'code' => 'max:6',
        'status' => 'in:open,completed,canceled',
        'priority' => 'in:low,medium,high',
        'start_date' => 'date',
        'end_date' => 'date|after:start_date',
        'contact' => 'exists:contacts,id',
        'users' => 'array|exists:users,id'
    ],
    'tasks' => [
        'name' => 'sometimes|required|string',
        'status' => 'in:open,completed,canceled',
        'priority' => 'in:low,medium,high',
        'start_date' => 'date',
        'end_date' => 'date|after:start_date',
        'project' => 'sometimes|required|exists:projects,id',
        'user' => 'exists:users,id',
    ],
    'teams' => [
        'name' => 'sometimes|required|string',
        'profile_img' => 'string',
        'background_img' => 'string',
        'users' => 'array|exists:users,id'
    ]
];
