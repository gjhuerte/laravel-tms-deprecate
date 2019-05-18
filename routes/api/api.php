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
    Route::namespace('ticket')->group(function() {
        Route::get('ticket/all', [
            'as' => 'api.ticket.index', 
            'uses' => 'TicketController@index'
        ]);

        Route::get('ticket/{id}/activity', [
            'as' => 'api.ticket.activity.index', 
            'uses' => 'ActivityController@index'
        ]);

        Route::post('ticket/activity/add', 'ActivityController@store');
    });



    Route::namespace('category')->group(function() {
        Route::get('category/all', [
            'as' => 'api.category.index', 
            'uses' => 'CategoryController@index'
        ]);

        Route::delete('category/{id?}', [
            'as' => 'api.category.destroy', 
            'uses' => 'CategoryController@destroy'
        ]);
    });

    Route::namespace('organization')->group(function() {
        Route::get('organization/all', [
            'as' => 'api.organization.index', 
            'uses' => 'OrganizationController@index'
        ]);

        Route::delete('organization/{id?}', [
            'as' => 'api.organization.destroy', 
            'uses' => 'OrganizationController@destroy'
        ]);
    });

    Route::namespace('level')->group(function() {
        Route::get('level/all', [
            'as' => 'api.level.index', 
            'uses' => 'LevelController@index'
        ]);

        Route::delete('level/{id?}', [
            'as' => 'api.level.destroy', 
            'uses' => 'LevelController@destroy'
        ]);
    });

});
