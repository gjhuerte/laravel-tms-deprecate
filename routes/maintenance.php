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

Route::namespace('Maintenance')->group(function() {
    Route::resource('organization', 'OrganizationController');
    Route::resource('level', 'LevelController');
    Route::resource('category', 'CategoryController');
});
