<?php

namespace App\Scopes;

trait StatusScope
{
    /**
     * Returns list of all the status has
     *
     * @return array list of status
     */
    public function allStatus()
    {
        return [
            self::INITIALIZED,
            self::VERIFIED,
            self::ASSIGNED,
            self::TRANSFERRED,
            self::WAITINGFORAPPROVAL,
            self::APPROVED,
            self::ENQUEUE,
            self::RESOLVING,
            self::RESOLVED,
            self::WAITINGFORFEEDBACK,
            self::CLOSED,
            self::REOPENED,
        ];
	}

	/**
	 * Enqueue the ticket to a staff
	 *
	 * @return string
	 */
	public function enqueuedStatus()
	{
		return self::ENQUEUE;
	}

	/**
	 * Returns the initialized status for ticket
	 * 
	 * @return string initialized
	 */
	public function initializedStatus()
	{
		return self::INITIALIZED;
	}
	
	/**
	 * Use the verified status and return the value from it
	 *
	 * @return string
	 */
	public function verifiedStatus()
	{
		return self::VERIFIED;
	}
	
	/**
	 * Use the assigned status and return the value from it
	 *
	 * @return string
	 */
	public function assignedStatus()
	{
		return self::ASSIGNED;
	}

	/**
	 * Returns the approved status 
	 *
	 * @return string
	 */
	public function approvedStatus()
	{
		return self::APPROVED;
	}

	/**
	 * Returns the approved status 
	 *
	 * @return string
	 */
	public function resolvedStatus()
	{
		return self::RESOLVED;
	}

	/**
	 * Returns the closed status for ticket
	 * 
	 * @return string initialized
	 */
	public function closedStatus()
	{
		return self::CLOSED;
	}

	/**
	 * Returns the reopened status for ticket
	 * 
	 * @return string initialized
	 */
	public function reopenedStatus()
	{
		return self::REOPENED;
	}
}
