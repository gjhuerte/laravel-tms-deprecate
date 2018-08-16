<?php

namespace App\Http\Packages\Maintenance;

use Route;

class Routes
{
	/**
	 * List all the routes available for 
	 * maintenance
	 * @return none
	 */
	public static function all()
	{
		Route::namespace('Maintenance')->group(function() {
			Route::resource('organization', 'OrganizationsController');
			Route::resource('level', 'LevelsController');
			Route::resource('category', 'CategoriesController');
			Route::resource('user', 'UsersController');
		});
	}
}