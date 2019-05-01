<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VerifyTicket implements ShouldQueue
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
        $ticket->update([ 'status' => Ticket::verifiedStatus() ]);

        $this->dispatch(new CreateActivity([
            'title' => 'Ticket ' . $ticket->code . ' verification',
            'details' => $this->ticket['details'],
        ], $this->id));
    }
}
