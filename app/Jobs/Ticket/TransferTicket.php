<?php

namespace App\Jobs\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class TransferTicket implements ShouldQueue
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

        $this->transferTicket();

        $this->setSessionMessage();

        DB::commit();
    }

    /**
     * Set the ticket as transfer
     *
     * @return void
     */
    private function transferTicket()
    {
        $this->ticket = $ticket = Ticket::findOrFail((int) $this->id);
        $title = $this->request['title'];
        $details = $this->request['reason'];

        dispatch(new CreateActivity([
            'title' => $title,
            'details' => $details,
        ], $this->id));

        $this->updateTicketStatusToTransfer($ticket);
    }

    /**
     * Set the ticket status to resolved
     *
     * @param Ticket $ticket
     * @return void
     */
    private function updateTicketStatusToTransfer($ticket)
    {
        $ticket->update([ 
            'status' => $ticket::TRANSFERRED,
            'date_assigned' => Carbon::now(),
            'assigned_to' => $this->request['transfer_to'],
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
            'message' => 'You have successfully transferred the ticket.',
            'payload' => [
                'ticket' => $this->ticket
            ]
        ]);
    }
}
