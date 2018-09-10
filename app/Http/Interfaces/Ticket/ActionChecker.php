<?php

namespace App\Http\Interfaces\Ticket\ActionChecker;

interface ActionChecker
{
	public function isClosed(int $ticketId);
}