<?php

namespace App\Jobs\Api\Ticket;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Ticket;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchAllMyAccessibleTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tickets;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->fetchTicket();

        $this->setSessionMessage();
    }

    /**
     * Create a level
     *
     * @return void
     */
    public function fetchTicket()
    {
        $request = $this->request;

        $this->tickets = Ticket::orderBy('created_at', 'desc')->paginate(10);
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
            'message' => 'You have successfully fetched all accessible tickets',
            'payload' => [
                'tickets' => $this->tickets
            ],
        ]);
    }
}
