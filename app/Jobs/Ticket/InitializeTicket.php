<?php

namespace App\Jobs\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitializeTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket = null)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Ticket $ticket)
    {
        $this->initializeTicket($ticket);

        $this->setSessionMessage();
    }

    /**
     * Initialize a ticket
     *
     * @return void
     */
    public function initializeTicket($ticket)
    {
        $ticket::create([
            'code' => $ticket->generateCode(),
            'title' => $this->ticket['title'] ?? null,
            'details' => $this->ticket['details'] ?? null,
            'alt_contact' => $this->ticket['contact'] ?? null,
            'additional_info' => $this->ticket['notes'] ?? null,
            'created_by' => Auth::id(),
            'level_id' => $this->ticket['level'] ?? null,
            'status' => $ticket->initializedStatus(),
        ]);
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
        ]);
    }
}
