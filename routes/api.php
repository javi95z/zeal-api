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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('signup', 'AuthController@signup');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'users'], function () {
    Route::post('index', 'UserController@index');
    Route::post('{id}', 'UserController@show');
    Route::post('', 'UserController@store');
    Route::put('{id}', 'UserController@update');
    Route::delete('{id}', 'UserController@destroy');
    Route::post('{id}/profile-image', 'UserController@profileImage');
});

Route::group(['prefix' => 'projects'], function () {
    Route::post('index', 'ProjectController@index');
    Route::post('{id}', 'ProjectController@show');
    Route::post('', 'ProjectController@store');
    Route::put('{id}', 'ProjectController@update');
    Route::delete('{id}', 'ProjectController@destroy');
    Route::post('{id}/progress', 'ProjectController@progress');
});

Route::group(['prefix' => 'tasks'], function () {
    Route::post('index', 'TaskController@index');
    Route::post('{id}', 'TaskController@show');
    Route::post('', 'TaskController@store');
    Route::put('{id}', 'TaskController@update');
    Route::delete('{id}', 'TaskController@destroy');
    Route::post('{id}/reports', 'TaskController@reports');
});

Route::group(['prefix' => 'roles'], function () {
    Route::post('index', 'RoleController@index');
    Route::post('{id}', 'RoleController@show');
    Route::post('', 'RoleController@store');
    Route::put('{id}', 'RoleController@update');
    Route::delete('{id}', 'RoleController@destroy');
});

Route::group(['prefix' => 'teams'], function () {
    Route::post('index', 'TeamController@index');
    Route::post('{id}', 'TeamController@show');
    Route::post('', 'TeamController@store');
    Route::put('{id}', 'TeamController@update');
    Route::delete('{id}', 'TeamController@destroy');
});

Route::group(['prefix' => 'contacts'], function () {
    Route::post('index', 'ContactController@index');
    Route::post('{id}', 'ContactController@show');
    Route::post('', 'ContactController@store');
    Route::put('{id}', 'ContactController@update');
    Route::delete('{id}', 'ContactController@destroy');
});

Route::group(['prefix' => 'reports'], function () {
    Route::post('', 'TaskReportController@store');
    Route::delete('{id}', 'TaskReportController@destroy');
});

Route::group(['prefix' => 'logs'], function () {
    Route::post('{id}', 'LogController@show');
});

Route::group(['prefix' => 'favorites'], function () {
    Route::post('index', 'FavoriteController@index');
    Route::post('', 'FavoriteController@store');
    Route::delete('{id}', 'FavoriteController@destroy');
});

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
