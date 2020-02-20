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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\UserController@login');
Route::get('charts', 'chartController@getSingleChart');
Route::get('/check', 'API\UserController@check');
Route::group(['middleware' => 'auth:api'], function(){
	Route::get('details', 'API\UserController@details');
    Route::get('regions', 'tableController@getFields');
	Route::get('nodes', 'formController@getNodes');
	Route::get('schedules', 'homeController@getSch');
	Route::get('reading', 'tableController@getLastData');
	Route::get('nodes', 'formController@getNodes');
});
