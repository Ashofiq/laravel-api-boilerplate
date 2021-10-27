<?php

// use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserGuard;

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

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api\v1',
    'prefix' => 'auth/v1'

], function ($router) {
    
    Route::post('registration', 'AuthController@reg')->name('reg')->withoutMiddleware([UserGuard::class]);
    Route::post('login', 'AuthController@login')->withoutMiddleware([UserGuard::class]);
    Route::post('logout', 'AuthController@logout')->withoutMiddleware([UserGuard::class]);
    Route::post('refresh', 'AuthController@refresh')->withoutMiddleware([UserGuard::class]);
    Route::post('me', 'AuthController@me')->withoutMiddleware([UserGuard::class]);

});


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api\v1',
    'prefix' => 'v1'
], function ($router) { 

    Route::get('all-user', 'User\UserController@allUser');
    Route::get('me', 'User\UserController@me');
    Route::get('helper', 'User\UserController@helper');

    

});