<?php

namespace App\Http\Packages\Ticketing;

use App\Nodels\Ticket;

class ActionChecker
{

	private $ticket;

	public function __construct()
	{
		$ticket = new Ticket;
	}

	/**
	 * Check if the status of the ticket is closed or not
	 * 
	 * @param  int     $ticketId ticket id for checking
	 * @return boolean           true if the ticket status is closed else false
	 */
	protected function isClosed(int $ticketId)
	{
		if($ticket->getStatusById(11)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if the status of the ticket is initialized or not
	 * 
	 * @param  int     $ticketId ticket id for checking
	 * @return boolean           true if the ticket status is initialized else false
	 */
	public function isInitialized(int $ticketId)
	{ 
		if($ticket->getStatusById(0)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if the ticket has been transferred even once
	 * 
	 * @param  int     $ticketId ticket id for checking
	 * @return boolean           true if the ticket has been transferred else false
	 */
	public function isTransferred(int $ticketId)
	{

		if($ticket->getStatusById(4)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if the ticket has been resolved
	 * 
	 * @param  int     $ticketId ticket id for checking
	 * @return boolean           true if the ticket has been resolved  else false
	 */
	public function isResolved(int $ticketId)
	{

		if($ticket->getStatusById(9)) {
			return true;
		}

		return false;
	}
}
