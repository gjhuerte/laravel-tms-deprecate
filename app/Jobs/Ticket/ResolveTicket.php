<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class ResolveTicket implements ShouldQueue
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

        $this->createASolution();

        $this->setSessionMessage();

        DB::commit();
    }

    /**
     * Set the ticket as resolved
     *
     * @return void
     */
    private function createASolution()
    {
        $this->ticket = $ticket = Ticket::findOrFail((int) $this->id);
        $code = $ticket->code;
        $isResolved = $this->request['is_resolved'] ?? null;
        $author = Auth::user()->full_name;
        $action = isset($isResolved) ? 'resolved' : 'added solution';
        $title = $this->request['title'];
        $details = $this->request['details'];

        dispatch(new CreateActivity([
            'title' => $title,
            'details' => $details,
            'author_id' => Auth::user()->id,
        ], $this->id));

        if($isResolved) {
            $this->updateTicketStatusToResolved($ticket);
        }
    }

    /**
     * Set the ticket status to resolved
     *
     * @param Ticket $ticket
     * @return void
     */
    private function updateTicketStatusToResolved($ticket)
    {
        $ticket->update([ 
            'status' => $ticket::RESOLVED 
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
            'message' => 'You have successfully created a solution for the ticket.',
            'payload' => [
                'ticket' => $this->ticket
            ]
        ]);
    }
}
