<?php

namespace App\Models\Ticket\Traits;

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
	 * Enqueue the ticket to a staff
	 *
	 * @return string
	 */
	public function enqueuedStatus()
	{
		return Ticket::ENQUEUE;
	}

	/**
	 * Returns the initialized status for ticket
	 * 
	 * @return string initialized
	 */
	public function initializedStatus()
	{
		return Ticket::INITIALIZED;
	}
	
	/**
	 * Use the verified status and return the value from it
	 *
	 * @return string
	 */
	public function verifiedStatus()
	{
		return Ticket::VERIFIED;
	}
	
	/**
	 * Use the assigned status and return the value from it
	 *
	 * @return string
	 */
	public function assignedStatus()
	{
		return Ticket::ASSIGNED;
	}

	/**
	 * Returns the approved status 
	 *
	 * @return string
	 */
	public function approvedStatus()
	{
		return Ticket::APPROVED;
	}

	/**
	 * Returns the approved status 
	 *
	 * @return string
	 */
	public function resolvedStatus()
	{
		return Ticket::RESOLVED;
	}

	/**
	 * Returns the closed status for ticket
	 * 
	 * @return string initialized
	 */
	public function closedStatus()
	{
		return Ticket::CLOSED;
	}

	/**
	 * Returns the reopened status for ticket
	 * 
	 * @return string initialized
	 */
	public function reopenedStatus()
	{
		return Ticket::REOPENED;
	}
}
