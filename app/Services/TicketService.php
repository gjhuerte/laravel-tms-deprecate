<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Ticket\Ticket;
use App\Services\Ticket\TagService;
use App\Services\Ticket\ActivityService;

class TicketService extends BaseService
{
    /**
     * Ticket tag model
     *
     * @var mixed
     */
    private $tagService;

    /**
     * Ticket activity model
     *
     * @var mixed
     */
    private $activityService;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->tagService = new TagService;
        $this->activityService = new ActivityService;
    }

    /**
     * Creates a new ticket with action
     *
     * @param $attributes Different attributes of ticket as array form
     * @return mixed
     */
    public function create($attributes)
    {
        $ticket = Ticket::create($attributes['ticket']);
        $this->activityService
            ->create(
                $attributes['activity'], 
                $ticket
            );

        if(isset($attributes['tags'])) {
            $this->tagService
                ->createMultipleAndAssignToTicket(
                    $attributes['tags'], 
                    $ticket
                );
        }

        return $ticket;
    }

    /**
     * Find a ticket
     *
     * @param integer $id
     * @return mixed
     */
    public function find($id)
    {
        $ticket = Ticket::find((integer) $id);

        return $ticket;
    }

    /**
     * Updates the ticket information
     *
     * @param array $attributes
     * @param integer $ticketId
     * @return mixed
     */
    public function update($attributes, $ticketId)
    {
        $ticket = $this->find((integer) $ticketId);
        $ticket->update($attributes);
        
        $this->activityService
            ->create(
                $attributes['activity'], 
                $ticket
            );

        return $ticket;
    }
}
