<?php

namespace App\Http\Packages\Ticketing;

use App\Models\Ticket as Ticket;
use App\Models\Ticket\Activity as Activity;
use App\Http\Interfaces\Ticket\Action as ActionInterface;

class Action implements ActionInterface
{
	public function initialize(int $id)
	{
        $details = 'A new ticket has been generated.';
        $title = 'Ticket Initialization';

        $activity = new Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $id,
        ]);

        return $this;
	}
	// public function verify(int $ticketId, int $userId, array $args);
	// public function requireApproval(int $ticketId);
	// public function approved(int $ticketId, int $userId);
	// public function enqueueToStaff(int $ticketId, int $staffId);
	// public function assign(int $ticketId, int $userId);
	// public function transfer(int $sourceId, int $destinationId);
	// public function create(array $args);
	// public function close(int $ticketId, string $description);
	// public function resolve(int $ticketId, string $description);
}