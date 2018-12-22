<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DashboardController@index');
Route::get('home', 'DashboardController@index');
Route::get('dashboard', 'DashboardController@index');

Route::middleware(['auth'])->group(function() {

	Route::namespace('user')->group(function() {
		Route::get('profile/{id}', [
			'as' => 'user.profile',
			'uses' => 'ProfileController@index'
		]);
		
		Route::get('settings', 'SettingController@index');
	});
	
});

App\Routes\Web\Ticket\Routes::all();
App\Routes\Web\Maintenance\Routes::all();
Auth::routes();
