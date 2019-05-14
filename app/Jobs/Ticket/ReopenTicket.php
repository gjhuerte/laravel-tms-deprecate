<?php

namespace App\Jobs\ticket;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class ReopenTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        $this->reopenTicket();

        $this->setSessionMessage();

        DB::commit();
    }

    /**
     * Set the ticket as resolved
     *
     * @return void
     */
    private function reopenTicket()
    {
        $this->ticket = $ticket = Ticket::findOrFail((int) $this->id);
        $code = $ticket->code;
        $author = Auth::user()->full_name;
        $action = 'reopen';
        $title = $this->request['title'];
        $details = $this->request['details'];

        dispatch(new CreateActivity([
            'title' => $title,
            'details' => $details,
        ], $this->id));

        $this->updateTicketStatusToReopen($ticket);
    }

    /**
     * Set the ticket status to resolved
     *
     * @param Ticket $ticket
     * @return void
     */
    private function updateTicketStatusToReopen($ticket)
    {
        $ticket->update([ 
            'status' => $ticket::REOPENED 
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
            'message' => 'You have successfully reopened the ticket.',
            'payload' => [
                'ticket' => $this->ticket
            ]
        ]);
    }
}
