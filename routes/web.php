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
Route::get('home', 'PagesController@getDashboard');
Route::get('dashboard', 'PagesController@getDashboard');

Route::middleware(['auth'])->group(function() {
	Route::get('settings', 'SettingsController@index');
});

App\Http\Packages\Ticketing\Routes::all();
App\Http\Packages\Maintenance\Routes::all();
Auth::routes();
