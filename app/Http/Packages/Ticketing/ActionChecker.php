<?php

namespace App\Http\Packages\Ticketing;

use App\Http\Interfaces\Ticket\ActionChecker as ActionCheckerInterface;

class ActionChecker implements ActionCheckerInterface
{
	protected function isClosed(int $ticketId)
	{
		return true;
	}
}