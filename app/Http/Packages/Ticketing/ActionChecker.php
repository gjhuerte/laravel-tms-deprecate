<?php

namespace App\Http\Packages\Ticketing;

use App\Http\Interfaces\Ticket\ActionChecker as ActionCheckerInterface;

class ActionChecker implements ActionCheckerInterface
{

	/**
	 * Check if the status of the ticket is closed or not
	 * 
	 * @param  int     $ticketId ticket id for checking
	 * @return boolean           true if the ticket action is closed else false
	 */
	protected function isClosed(int $ticketId)
	{
		return true;
	}
}