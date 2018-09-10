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
	protected function initialize(int $id)
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
	// protected function verify(int $ticketId, int $userId, array $args);
	// protected function requireApproval(int $ticketId);
	// protected function approved(int $ticketId, int $userId);
	// protected function enqueueToStaff(int $ticketId, int $staffId);
	// protected function assign(int $ticketId, int $userId);
	// protected function transfer(int $sourceId, int $destinationId);
	// protected function create(array $args);
	 
	/**
	 * Tags the argument ticket as closed
	 * 
	 * @param  int    $ticketId ticket id to be tagged as closed
	 * @param  string $remarks  additional remarks when closing the ticket
	 * @return pointer reference
	 */
	protected function close(int $ticketId, string $remarks)
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
            'ticket_id' => $ticketId,
        ]);

        return $this;
	}

	/**
	 * Tags the closed ticket as open
	 * 
	 * @param  int    $ticketId ticket id to be tagged as closed
	 * @param  string $remarks  additional remarks when closing the ticket
	 * @return pointer reference
	 */
	protected function reopen($ticketId, $remarks)
	{
        $user = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $details = 'User ' . $user . ' reopens the ticket';
        $title = 'Ticket Reopening';

        /**
         * tags the ticket as reopen
         */
        $this->status = $this->getStatusById(0);
        $this->save();

        $activity = new Ticket\Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $ticketId,
        ]);

        return $this;
	}

	// protected function resolve(int $ticketId, string $description);
}