<?php

namespace App\Http\Interfaces\Ticket\ActionChecker;

interface ActionChecker
{
	public function isClosed(int $ticketId);
	public function isInitialized(int $ticketId);
	public function isTransferred(int $ticketId);
	public function isResolved(int $ticketId);
}