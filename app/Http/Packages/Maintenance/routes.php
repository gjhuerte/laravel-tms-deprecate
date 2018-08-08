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
		Route::namespace()->group(function() {
			Route::resource('category', 'CategoriesController');
		});
	}
}