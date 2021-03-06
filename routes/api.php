<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::apiResources([
        'user' => 'UserController',
        'roles' => 'RoleController',
        'permissions' => 'PermissionController',
    ], ['only' => ['index', 'store', 'update', 'destroy']]);

    Route::get('roles/list', 'RoleController@list');
    Route::get('permissions/list', 'PermissionController@list');
    // Route::resource('permissions', PermissionController::class)->only(['index', 'store']);

});