<?php

namespace App\Http\Packages\Ticketing;

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
		Route::middleware(['auth'])->group(function() {
			Route::resource('ticket', 'TicketsController');
		});
	}
}