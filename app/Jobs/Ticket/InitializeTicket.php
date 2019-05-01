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
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Ticket::create([
            'title' => $this->ticket['title'],
            'details' => $this->ticket['details'],
            'alt_contact' => $this->ticket['alternative_contact'],
            'additional_info' => $this->ticket['additional_information'],
            'created_by' => Auth::id(),
            'level_id' => $this->ticket['level'],
            'status' => Ticket::initializedStatus(),
        ]);
    }
}
