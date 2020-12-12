<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'users'], function () {
    Route::post('index', 'UserController@index');
    Route::post('{id}', 'UserController@show');
    Route::post('', 'UserController@store');
    Route::put('{id}', 'UserController@update');
    Route::delete('{id}', 'UserController@destroy');
});

Route::group(['prefix' => 'projects'], function () {
    Route::post('index', 'ProjectController@index');
    Route::post('{id}', 'ProjectController@show');
    Route::post('', 'ProjectController@store');
    Route::put('{id}', 'ProjectController@update');
    Route::delete('{id}', 'ProjectController@destroy');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::post('index', 'TaskController@index');
    Route::post('{id}', 'TaskController@show');
    Route::post('', 'TaskController@store');
    Route::put('{id}', 'TaskController@update');
    Route::delete('{id}', 'TaskController@destroy');
});

Route::group(['prefix' => 'roles'], function () {
    Route::post('index', 'RoleController@index');
});

Route::group(['prefix' => 'teams'], function () {
    Route::post('index', 'TeamController@index');
    Route::post('{id}', 'TeamController@show');
    Route::put('{id}', 'TeamController@update');
    Route::delete('{id}', 'TeamController@destroy');
});

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
