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
        'last_name' => 'required',
        'email' => 'required|unique:users,email|max:100',
        'active' => 'boolean',
        'suffix' => 'max:10',
        'gender' => 'in:male,female',
        'is_admin' => 'boolean',
        'role' => 'numeric',
        'teams' => 'array'
    ]
];
