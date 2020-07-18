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
//Route::post('auth', 'API\UserController@login');
Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'] ], function(){
    Route::get('/auth/check','API\AuthController@check');
    Route::get('/auth/revoke','API\AuthController@revoke');

    Route::get('/users','API\UserController@index');
    Route::post('/users','API\UserController@store');
    Route::put('/users','API\UserController@update');

    Route::get('/companies','API\CompanyController@index');
    Route::post('/companies','API\CompanyController@store');
    Route::delete('/companies/{company}', 'API\CompanyController@delete');
    Route::put('/companies','API\CompanyController@update');

    Route::get('/locations','API\LocationController@index');
    Route::post('/locations','API\LocationController@store');
    Route::delete('/locations/{location}', 'API\LocationController@delete');
    Route::put('/locations','API\LocationController@update');

    Route::get('/locations/groups','API\LocationGroupController@index');
    Route::post('/locations/groups','API\LocationGroupController@store');
    // Route::delete('/locations/groups/{location}', 'API\LocationGroupController@delete');
    Route::put('/locations/groups','API\LocationGroupController@update');
});
