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

Route::middleware('auth:api')
    ->namespace('api')
    ->group(function() {
    Route::namespace('ticket')
        ->prefix('ticket')
        ->group(function() {
        Route::get('all', [
            'as' => 'api.ticket.index', 
            'uses' => 'TicketController@index'
        ]);

        Route::delete('{id}', [
            'as' => 'api.ticket.destroy', 
            'uses' => 'TicketController@destroy'
        ]);

        Route::get('{id}/activity', [
            'as' => 'api.ticket.activity.index', 
            'uses' => 'ActivityController@index'
        ]);

        Route::post('activity/add', 'ActivityController@store');

        Route::get('tag/all', [
            'as' => 'api.ticket.tag.index', 
            'uses' => 'TagController@index'
        ]);

        Route::delete('tag/{id?}', [
            'as' => 'api.ticket.tag.destroy', 
            'uses' => 'TagController@destroy'
        ]);

        Route::prefix('category')
            ->group(function() {
            Route::get('/', [
                'as' => 'api.category.index', 
                'uses' => 'CategoryController@index'
            ]);

            Route::delete('{id?}', [
                'as' => 'api.category.destroy', 
                'uses' => 'CategoryController@destroy'
            ]);
        });

        Route::prefix('level')
            ->group(function() {
            Route::get('/', [
                'as' => 'api.level.index', 
                'uses' => 'LevelController@index'
            ]);

            Route::delete('{id?}', [
                'as' => 'api.level.destroy', 
                'uses' => 'LevelController@destroy'
            ]);
        });
    });

    Route::namespace('user')
        ->prefix('user')
        ->group(function() {
        Route::get('/', [
            'as' => 'api.user.index',
            'uses' => 'UserController@index',
        ]);

        Route::delete('{id?}', [
            'as' => 'api.user.destroy', 
            'uses' => 'UserController@destroy'
        ]);

        Route::prefix('organization')
            ->group(function() {
            Route::get('/', [
                'as' => 'api.organization.index', 
                'uses' => 'OrganizationController@index'
            ]);

            Route::delete('{id?}', [
                'as' => 'api.organization.destroy', 
                'uses' => 'OrganizationController@destroy'
            ]);
        });
    });

});
