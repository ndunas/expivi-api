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

Route::post('/client', [
	'uses' => 'ClientsController@postClient'
]);

Route::post('/filter', [
	'uses' => 'ClientsController@filterClients'
]);

Route::get('/client', [
	'uses' => 'ClientsController@getClients'
]);

Route::get('/find/{id}', [
	'uses' => 'ClientsController@findClient'
]);

Route::put('/client/{id}', [
	'uses' => 'ClientsController@putClient'
]);

Route::delete('/client/{id}', [
	'uses' => 'ClientsController@deleteClient'
]);
