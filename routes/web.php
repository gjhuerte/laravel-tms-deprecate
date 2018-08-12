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

Route::get('/', 'PagesController@getDashboard');
Route::get('dashboard', 'PagesController@getDashboard');

Route::namespace('Auth')->group(function() {
	Route::get('login', 'AuthenticationController@getLoginForm');
	Route::post('login', 'AuthenticationController@login');
});

Route::middleware(['auth'])->group(function() {
	Route::get('settings', 'SettingsController@index');

	Route::namespace('Auth')->group(function() {
		Route::get('logout', 'AuthenticationController@logout');
	});
});

App\Http\Packages\Ticketing\Routes::all();
App\Http\Packages\Maintenance\Routes::all();
