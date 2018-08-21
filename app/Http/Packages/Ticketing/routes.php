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
			Route::prefix('ticket')->group(function() {
				Route::get('{id}/close', 'TicketsController@close');
				Route::get('{id}/reopen', 'TicketsController@reopen');
			});

			Route::resource('ticket', 'TicketsController');
		});
	}
}