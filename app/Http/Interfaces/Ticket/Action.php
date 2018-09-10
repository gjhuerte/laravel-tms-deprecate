<?php

namespace App\Http\Interfaces\Ticket;

interface Action
{
	public function initialize(int $id);
	public function verify(int $ticketId, int $userId, array $args);
	public function requireApproval(int $ticketId);
	public function approved(int $ticketId, int $userId);
	public function enqueueToStaff(int $ticketId, int $staffId);
	public function assign(int $ticketId, int $userId);
	public function transfer(int $sourceId, int $destinationId);
	public function create(array $args);
	public function close(int $ticketId, string $description);
	public function reopen(int $ticketId, string $description);
	public function isClosed($ticketId);
	public function resolve(int $ticketId, string $description);
}