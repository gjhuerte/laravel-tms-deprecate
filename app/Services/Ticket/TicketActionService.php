<?php

namespace App\Services\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Ticket;
use App\Services\BaseService;
use App\Services\TicketService;
use App\Services\Ticket\TagService;
use Illuminate\Support\Facades\Auth;

class TicketActionService extends BaseService
{
    private $ticketService;
    private $tagService;
    private $ticket;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->ticketService = new TicketService;
        $this->tagService = new TagService;
        $this->ticket = new Ticket;

        return;
    }

    /**
     * Initialize a new ticket
     *
     * @return mixed
     */
    public function initialize($attributes)
    {
        $authorId = Auth::id();
        $title = $attributes['title'] ?? null;
        $details = $attributes['details'] ?? null;
        $contact = $attributes['contact'] ?? null;
        $notes = $attributes['notes'] ?? null;
        $levelId = $attributes['level'] ?? null;
        $tags = $attributes['tags'] ?? [];
        $code = $this->ticket->generateCode();
        $status = $this->ticket->initializedStatus();
        $tags = $attributes['tags'] ?? '';

        $this->ticketService->create([
            'ticket' => [
                'code' => $code,
                'title' => $title,
                'details' => $details,
                'alt_contact' => $contact,
                'additional_info' => $notes,
                'level_id' => $levelId,
                'author_id' => $authorId,
                'status' => $status,
            ],
            'tags' => $tags,
            'activity' => [
                'title' => 'Ticket initialized',
                'details' => 'This ticket has been initialized.',
                'author_id' => $authorId,
            ],
        ]);

        return;
    }

    /**
     * Update ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function update($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $details = $attributes['details'];
        $title = $attributes['title'] ?? null;
        $details = $attributes['details'] ?? null;
        $contact = $attributes['contact'] ?? null;
        $notes = $attributes['notes'] ?? null;
        $levelId = $attributes['level'] ?? null;
        $authorId = Auth::id();
        $author = Auth::user();
        $date = Carbon::now()->toFormattedDateTimeString();
        $args = [
            'ticket' => [
                'title' => $title,
                'details' => $details,
                'alt_contact' => $contact,
                'additional_info' => $notes,
                'level_id' => $levelId,
            ],
            'activity' => [
                'title' => 'Ticket Updated',
                'details' => "Ticket information updated by {$author->full_name} on {$date}",
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Resolve the ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function resolve($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $title = $attributes['title'] ?? null;
        $details = $attributes['details'] ?? null;
        $isResolved = $attributes['is_resolved'] ?? null;
        $authorId = Auth::id();
        $status = $ticket::RESOLVED;
        $args = [
            'ticket' => [
                'title' => $title,
                'details' => $details,
                'alt_contact' => $contact,
                'additional_info' => $notes,
                'level_id' => $levelId,
                'author_id' => $authorId,
                'status' => $status,
            ],
            'activity' => [
                'title' => $title,
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        if($isResolved) {
            $args = array_merge($args, ['status' => $status]);
        }

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Verify ticket before approval
     * 
     * @param array $attributes
     * @return mixed
     */
    public function verify($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $details = $attributes['details'];
        $authorId = Auth::id();
        $status = $ticket->verifiedStatus();
        $args = [
            'ticket' => [
                'status' => $status,
            ],
            'activity' => [
                'title' => 'Verified',
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Approve ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function approve($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $details = $attributes['details'];
        $authorId = Auth::id();
        $status = $ticket->approvedStatus();
        $args = [
            'ticket' => [
                'status' => $status,
            ],
            'activity' => [
                'title' => 'Approved',
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Enqueue ticket for staff usage
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function enqueue($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $authorId = Auth::id();
        $status = $ticket->enqueuedStatus();
        $args = [
            'ticket' => [
                'status' => $status,
            ],
            'activity' => [
                'title' => 'Ticket Enqueued',
                'details' => 'Action may now be applied to this ticket',
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Assign a personnel to the ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function assign($attributes, $ticketId)
    {
        $ticket = $this->ticketService->find($ticketId);
        $assignedPersonnel = $attributes['assigned_personnel'];
        $authorId = Auth::id();
        $author = Auth::user();
        $status = $ticket::assignedStatus();
        $currentDate = Carbon::now();
        $args = [
            'ticket' => [
                'status' => $status,
                'date_assigned' => $currentDate,
                'assigned_to' => $assignedPersonnel,
            ],
            'activity' => [
                'title' => "Ticket assigned by {$author->full_name}",
                'details' => "The ticket has been assigned to a personnel",
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Transfer ticket to another personnel
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function transfer($attributes, $ticketId)
    {
        $ticket = $this->ticketService->find($ticketId);
        $assignedPersonnel = $attributes['transfer_to'];
        $authorId = Auth::id();
        $title = $attributes['title'];
        $details = $attributes['reason'];
        $status = $ticket::TRANSFERRED;
        $currentDate = Carbon::now();
        $args = [
            'ticket' => [
                'status' => $status,
                'date_assigned' => $currentDate,
                'assigned_to' => $assignedPersonnel,
            ],
            'activity' => [
                'title' => $title,
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Close the ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function close($attributes, $ticketId)
    {

        $ticket = $this->ticket;
        $title = $attributes['title'];
        $details = $attributes['details'];
        $authorId = Auth::id();
        $status = $ticket::CLOSED;
        $args = [
            'ticket' => [
                'status' => $status,
            ],
            'activity' => [
                'title' => $title,
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }

    /**
     * Reopen ticket
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function reopen($attributes, $ticketId)
    {
        $ticket = $this->ticket;
        $title = $attributes['title'];
        $details = $attributes['details'];
        $authorId = Auth::id();
        $status = $ticket::REOPENED;
        $args = [
            'ticket' => [
                'status' => $status,
            ],
            'activity' => [
                'title' => $title,
                'details' => $details,
                'author_id' => $authorId,
            ]
        ];

        $this->ticketService->update($args, $ticketId);

        return;
    }
}
