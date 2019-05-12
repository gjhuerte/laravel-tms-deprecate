<?php

namespace App\Jobs\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use App\Jobs\Ticket\Tag\CreateTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitializeTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request = null)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Ticket $ticket)
    {

        DB::beginTransaction();

        $this->initializeTicket($ticket);

        $this->createAndAssignTags();

        DB::commit();

        $this->setSessionMessage();
    }

    /**
     * Initialize a ticket
     *
     * @return void
     */
    public function initializeTicket($ticket)
    {
        $this->ticket = $ticket::create([
            'code' => $ticket->generateCode(),
            'title' => $this->request['title'] ?? null,
            'details' => $this->request['details'] ?? null,
            'alt_contact' => $this->request['contact'] ?? null,
            'additional_info' => $this->request['notes'] ?? null,
            'created_by' => Auth::id(),
            'level_id' => $this->request['level'] ?? null,
            'status' => $ticket->initializedStatus(),
        ]);
    }

    /**
     * Create and assign tags to ticket
     *
     * @return void
     */
    public function createAndAssignTags()
    {
        $tag = new CreateTag(
            $this->request['tags'] ?? [],
            $this->ticket
        );

        $tag->handle();

        return;
    }

    /**
     * Set the session message
     *
     * @return void
     */
    public function setSessionMessage()
    {
        session()->flash('notification', [
            'type' => 'success',
            'title' => 'Awesome!',
            'message' => 'You have successfully created a ticket',
            'payload' => [
                'ticket' => $this->ticket
            ]
        ]);
    }
}
