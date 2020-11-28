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
        'last_name' => 'sometimes|required',
        'email' => 'sometimes|required|unique:users,email|max:100',
        'active' => 'boolean',
        'suffix' => 'max:10',
        'gender' => 'in:male,female',
        'is_admin' => 'boolean',
        'role' => 'numeric',
        'teams' => 'array'
    ],
    'projects' => [
        'name' => 'sometimes|required|string',
        'contact' => 'numeric',
        'code' => 'max:6',
        'status' => 'in:open,completed,canceled',
        'priority' => 'in:low,medium,high',
        'start_date' => 'date',
        'end_date' => 'date|after:start_date'
    ]
];
