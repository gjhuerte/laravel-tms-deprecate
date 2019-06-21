<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\DB;
use App\Services\Ticket\TagService;
use App\Services\Ticket\ActivityService;

class TicketService extends BaseService
{
    /**
     * Ticket information
     *
     * @var mixed
     */
    private $ticket;

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
        DB::beginTransaction();

        $ticket = Ticket::create($attributes['ticket']);
        $this->activityService
            ->create(
                $attributes['activity'], 
                $ticket->id
            );

        if(isset($attributes['tags'])) {
            $this->tagService
                ->createMultipleAndAssignToTicket(
                    $attributes['tags'], 
                    $ticket
                );
        }

        DB::commit();

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
        if(! isset($this->ticket)) {
            $this->ticket = Ticket::find((integer) $id);
        }

        return $this->ticket;
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
        DB::beginTransaction();

        $ticket = $this->find((integer) $ticketId);
        if(isset($attributes) && count($attributes) > 0) { 
            $ticket->update($attributes);
        }
        
        $this->activityService
            ->create(
                $attributes['activity'], 
                $ticket->id
            );

        DB::commit();

        return $ticket;
    }
}
