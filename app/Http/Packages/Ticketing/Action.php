<?php

namespace App\Http\Packages\Ticketing;

use App\Models\Ticket as Ticket;
use App\Models\Ticket\Activity as Activity;
use App\Http\Interfaces\Ticket\Action as ActionInterface;

class Action implements ActionInterface
{

	/**
	 * Create an activity for initialized ticket
	 * 
	 * @param  int    $id ticket id
	 * @return object     this
	 */
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
	 
	/**
	 * Tags the argument ticket as closed
	 * 
	 * @param  int    $ticketId ticket id to be tagged as closed
	 * @param  string $remarks  additional remarks when closing the ticket
	 * @return pointer reference
	 */
	public function close(int $ticketId, string $remarks)
	{
        $user = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $details = 'User ' . $user . ' tags the ticket as closed';
        $title = 'Ticket Closing';

        /**
         * tags the ticket as closed
         */
        $this->status = $this->getStatusById(11);
        $this->save();

        $activity = new Ticket\Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $this->id,
        ]);

        return $this;
	}
	
	// public function resolve(int $ticketId, string $description);
}