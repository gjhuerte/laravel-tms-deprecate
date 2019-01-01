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

Route::middleware('auth:api')->namespace('api')->group(function() {
    // Route::namespace('ticket')->group(function() {
        // Route::resource('ticket', 'TicketController', [ 'only' => array('index', 'show', 'store')]);
        // Route::post('ticket/activity/add', 'ActivityController@store');
    // });

    Route::namespace('category')->group(function() {
        Route::get('category/all', ['as' => 'api.category.index', 'uses' => 'CategoryController@index']);
    });

});
