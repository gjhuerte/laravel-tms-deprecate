<?php

namespace App\Enumerables;

use App\Enumerables\BaseEnum;

class TicketEnum extends BaseEnum
{
    const INITIALIZED = 'Initialized';
    const VERIFIED = 'Verified';
    const ASSIGNED = 'Assigned';
    const TRANSFERRED = 'Transferred';
    const WAITINGFORAPPROVAL = 'Waiting for approval';
    const APPROVED = 'Approved';
    const ENQUEUE = 'Enqueue';
    const RESOLVING = 'Resolving';
    const RESOLVED = 'Resolved';
    const WAITINGFORFEEDBACK = 'Waiting for feedback';
    const CLOSED = 'Closed';
    const REOPENED = 'Reopened';
}
