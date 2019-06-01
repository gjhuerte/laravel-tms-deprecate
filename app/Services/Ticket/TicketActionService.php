<?php

namespace App\Services\Ticket;

use App\Models\Ticket\Ticket;
use App\Services\BaseService;
use App\Services\TicketService;
use Illuminate\Support\Facades\Auth;

class TicketActionService extends BaseService
{
    private $ticketService;
    private $ticket;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->ticketService = new TicketService;
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

        $this->ticketService->create([
            'title' => $title,
            'details' => $details,
            'alt_contact' => $contact,
            'additional_info' => $notes,
            'level_id' => $levelId,
            'tags' => $tags,
            'code' => $code,
            'status' => $status,
            'created_by' => $authorId,
            'author_id' => $authorId,
            'activity' => [
                'title' => 'Ticket initialized',
                'details' => 'This ticket has been initialized.',
                'author_id' => $authorId,
            ]
        ]);

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
        $this->ticket = $ticket = Ticket::findOrFail((int) $this->id);
        $isResolved = $attributes['is_resolved'] ?? null;
        $title = $attributes['title'];
        $details = $attributes['details'];
        $authorId = Auth::id();
        $ticket = $this->ticket;
        $ticketId = $ticketId;
        $title = $attributes['title'] ?? null;
        $details = $attributes['details'] ?? null;
        $contact = $attributes['contact'] ?? null;
        $notes = $attributes['notes'] ?? null;
        $levelId = $attributes['level'] ?? null;
        $code = $ticket->generateCode();
        $status = $ticket::RESOLVED;
        $activityTitle = $attributes['activity']['title'];
        $activityDetails = $attributes['activity']['details'];
        $args = [
            'title' => $title,
            'details' => $details,
            'alt_contact' => $contact,
            'additional_info' => $notes,
            'level_id' => $levelId,
            'code' => $code,
            'created_by' => $authorId,
            'author_id' => $authorId,
            'activity' => [
                'title' => $activityTitle,
                'details' => $activityDetails,
                'author_id' => $authorId,
            ]
        ];

        if($isResolved) {
            $args = array_merge($args, ['status' => $status]);
        }

        $this->ticketService->update($args, $ticketId);

        return;
    }

    public function approve()
    {

    }

    public function enqueue()
    {

    }

    public function reopen()
    {

    }

    public function assign()
    {

    }

    public function transfer()
    {

    }

    public function update()
    {

    }

    public function verify()
    {

    }

    public function close()
    {

    }
}
