<?php

namespace App\Routes\Web\Ticketing;

use Illuminate\Support\Facades\Route;

class Routes
{
	
	/**
	 * Routes used for ticketing purposes
	 * 
	 * @return 
	 */
	public static function all()
	{
		$routes = new Routes;
		Route::middleware(['auth'])->group(function() {
			Route::prefix('ticket')->namespace('ticket')->group(function() {
				Route::get('ticket/{id}/resolve', 'ResolveTicketController@create');
				Route::post('ticket/{id}/resolve', 'ResolveTicketController@resolve');

				Route::get('ticket/{id}/close', 'CloseTicketController@create');
				Route::post('ticket/{id}/close', 'CloseTicketController@close');

				Route::get('ticket/{id}/reopen', 'ReopenTicketController@create');
				Route::post('ticket/{id}/reopen', 'ReopenTicketController@reopen');

				Route::get('ticket/{id}/transfer', 'TransferTicketController@create');
				Route::post('ticket/{id}/transfer', 'TransferTicketController@transfer');

				Route::resource('ticket', 'TicketController');
			});
		});
	}
}
