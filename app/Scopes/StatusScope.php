<?php

namespace App\Scopes;

use App\Enumerables\TicketEnum;

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
            TicketEnum::INITIALIZED,
            TicketEnum::VERIFIED,
            TicketEnum::ASSIGNED,
            TicketEnum::TRANSFERRED,
            TicketEnum::WAITINGFORAPPROVAL,
            TicketEnum::APPROVED,
            TicketEnum::ENQUEUE,
            TicketEnum::RESOLVING,
            TicketEnum::RESOLVED,
            TicketEnum::WAITINGFORFEEDBACK,
            TicketEnum::CLOSED,
            TicketEnum::REOPENED,
        ];
    }

    /**
     * Enqueue the ticket to a staff
     *
     * @return string
     */
    public function enqueuedStatus()
    {
        return TicketEnum::ENQUEUE;
    }

    /**
     * Returns the initialized status for ticket
     *
     * @return string initialized
     */
    public function initializedStatus()
    {
        return TicketEnum::INITIALIZED;
    }

    /**
     * Returns the tansferred status for ticket
     *
     * @return string tansferred
     */
    public function transferredStatus()
    {
        return TicketEnum::TRANSFERRED;
    }
    
    /**
     * Use the verified status and return the value from it
     *
     * @return string
     */
    public function verifiedStatus()
    {
        return TicketEnum::VERIFIED;
    }
    
    /**
     * Use the assigned status and return the value from it
     *
     * @return string
     */
    public function assignedStatus()
    {
        return TicketEnum::ASSIGNED;
    }

    /**
     * Returns the approved status
     *
     * @return string
     */
    public function approvedStatus()
    {
        return TicketEnum::APPROVED;
    }

    /**
     * Returns the approved status
     *
     * @return string
     */
    public function resolvedStatus()
    {
        return TicketEnum::RESOLVED;
    }

    /**
     * Returns the closed status for ticket
     *
     * @return string initialized
     */
    public function closedStatus()
    {
        return TicketEnum::CLOSED;
    }

    /**
     * Returns the reopened status for ticket
     *
     * @return string initialized
     */
    public function reopenedStatus()
    {
        return TicketEnum::REOPENED;
    }
}
