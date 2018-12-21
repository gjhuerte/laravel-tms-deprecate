<?php

namespace App\Http\Packages\Ticketing;

use App\Models\Ticket;

trait Stateable
{
    /**
     * Returns list of all the status the ticket has
     *
     * @return array list of status
     */
    public function allStatus()
    {
        return [
            Ticket::INITIALIZED,
            Ticket::VERIFIED,
            Ticket::ASSIGNED,
            Ticket::TRANSFERRED,
            Ticket::WAITINGFORAPPROVAL,
            Ticket::APPROVED,
            Ticket::ENQUEUE,
            Ticket::RESOLVING,
            Ticket::RESOLVED,
            Ticket::WAITINGFORFEEDBACK,
            Ticket::CLOSED,
            Ticket::REOPENED,
        ];
    }

	/**
	 * Returns the initialized status for ticket
	 * 
	 * @return string initialized
	 */
	protected function initializedStatus()
	{
		return Ticket::INITIALIZED;
	}

	/**
	 * Returns the closed status for ticket
	 * 
	 * @return string initialized
	 */
	protected function closedStatus()
	{
		return Ticket::CLOSED;
	}

	/**
	 * Returns the reopened status for ticket
	 * 
	 * @return string initialized
	 */
	protected function reopenedStatus()
	{
		return Ticket::REOPENED;
	}
}
