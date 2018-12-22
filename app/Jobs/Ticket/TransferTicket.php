<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TransferTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ticket, $id)
    {
        $this->ticket = $ticket;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ticket = Ticket::findOrFail($id);
        $sourcePersonnel = $ticket->assigned_personnel;

        $ticket->update([ 
            'date_assigned' => Carbon::now(),
            'assigned_to' => $this->ticket['personnel'],
        ]);

        $this->dispatch(new CreateActivity([
            'title' => "Ticket {$ticket->code} transferred by Auth::user()->full_name",
            'details' => "The ticket has been transferred by {Auth::user()->full_name} from {$sourcePersonnel} to {$ticket->assigned_personnel}",
        ], $this->id));
    }
}
