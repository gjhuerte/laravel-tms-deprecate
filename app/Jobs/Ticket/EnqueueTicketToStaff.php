<?php

namespace App\Jobs\Ticket;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Ticket;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EnqueueTicketToStaff implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Ticket::findOrFail($id)->update([
            'status' => Ticket::enqueuedStatus(),
        ]);
    }
}
