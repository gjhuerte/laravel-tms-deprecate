<?php

/*
|--------------------------------------------------------------------------
| Maintenance Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Maintenance routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Maintenance')
    ->prefix('maintenance')
    ->group(function () {

    Route::namespace('User')
        ->prefix('user')
        ->group(function () {
        Route::resource('user', 'UserController');
        Route::resource('organization', 'OrganizationController');
    });

    Route::namespace('Ticket')
        ->prefix('ticket')
        ->group(function () {
        Route::resource('level', 'LevelController');
        Route::resource('category', 'CategoryController');
        Route::resource('tag', 'TagController', [
            'as' => 'ticket',
        ]);
    });
});
