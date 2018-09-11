<?php

namespace App\Http\Packages\Ticketing;

use App\Models\Ticket;

trait Status
{
	/**
	 * Returns the initialized status for ticket
	 * 
	 * @return string initialized
	 */
	protected function getInitializedStatus()
	{
		return Ticket::INITIALIZED;
	}
}