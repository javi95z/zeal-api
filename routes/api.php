<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
});

Route::middleware(['auth:api', 'cors'])->group(function () {
    Route::apiResources([
        'addresses' => 'AddressController',
        'accounts' => 'AccountController',
        'contacts' => 'ContactController',
        'currencies' => 'CurrencyController',
        'languages' => 'LanguageController',
        'projects' => 'ProjectController',
        'roles' => 'RoleController',
        'teams' => 'TeamController',
        'tasks' => 'TaskController',
        'users' => 'UserController'
    ]);
});

