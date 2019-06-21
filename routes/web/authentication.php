<?php

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register authentication routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function() {

	Route::namespace('user')->group(function() {
		Route::get('profile/{id}', [
			'as' => 'user.profile',
			'uses' => 'ProfileController@index'
		]);
		
		Route::get('settings', 'SettingController@index');
	});
	
});

Auth::routes(['register' => false]);
