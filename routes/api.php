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

Route::post('auth/login', 'AuthController@login');

Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::post('index', 'UserController@index');
        Route::post('{id}', 'UserController@show');
        Route::put('{id}', 'UserController@update');
        Route::delete('{id}', 'UserController@destroy');
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::post('index', 'ProjectController@index');
        Route::post('{id}', 'ProjectController@show');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::post('index', 'RoleController@index');
    });

    Route::group(['prefix' => 'teams'], function () {
        Route::post('index', 'TeamController@index');
    });
});

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
