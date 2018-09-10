<?php

namespace App\Http\Packages\Ticketing;

use Route;
use App\Http\Packages\Ticketing\UrlCatalog;

class Routes
{

    use UrlCatalog;
	private static $params;
	private static $middleware;

	public function __construct() {
		self::$params = [
			'routeAvailability' => true,
		];

		self::$middleware = [
			'auth'
		];
	}
	/**
	 * List all the routes available for 
	 * maintenance
	 * @return none
	 */
	public static function all()
	{
		$routes = new Routes;
		Route::middleware(self::$middleware)->group(function() use ($routes) {
			Route::prefix($routes->getBasePrefix())->group(function() use ($routes) {
				Route::post($routes->getClosedUrl(self::$params), 'TicketsController@close');
				Route::post($routes->getReopenUrl(self::$params), 'TicketsController@reopen');
			});

			Route::resource($routes->getIndexUrl(), 'TicketsController');
		});
	}
}