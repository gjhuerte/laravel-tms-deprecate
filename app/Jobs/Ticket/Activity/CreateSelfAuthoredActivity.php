<?php

namespace App\Jobs\Ticket\Activity;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Ticket\Activity\CreateActivity;

class CreateSelfAuthoredActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $activity;
    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($activity, $id)
    {
        $this->activity = $activity;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->dispatch(new CreateActivity([
            'title' => $this->activity['title'],
            'details' => $this->activity['details'],
            'ticket_id' => $this->id,
            'author_id' => Auth::id(),
        ]));
    }
}
