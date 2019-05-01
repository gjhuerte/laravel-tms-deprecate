<?php

namespace App\Routes\Web\Maintenance;

use Illuminate\Support\Facades\Route;

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
			Route::resource('organization', 'OrganizationController');
			Route::resource('level', 'LevelController');
			Route::resource('category', 'CategoryController');
		});
	}
}
