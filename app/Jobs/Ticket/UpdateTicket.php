<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class UpdateTicket implements ShouldQueue
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
        $ticket = Ticket::findOrFail($this->id);
        $ticket->update([
            'title' => $this->ticket['title'],
            'details' => $this->ticket['details'],
            'alt_contact' => $this->ticket['alternative_contact'],
            'additional_info' => $this->ticket['additional_information'],
            'level_id' => $this->ticket['level'],
        ]);

        $this->dispatch(new CreateActivity([
            'title' => 'Ticket ' . $ticket->code . ' update',
            'details' => 'Details of ticket ' . $ticket->code . ' has been updated by user ' . Auth::user()->full_name,
        ], $this->id));
    }
}
