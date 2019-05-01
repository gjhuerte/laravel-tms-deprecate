<?php

namespace App\Jobs\Ticket\Activity;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Activity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateActivity implements ShouldQueue
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
        Activity::create([
            'author_id' => isset($this->activity['author_id']) ? $this->activity['author_id'] : null,
            'details' => $this->activity['details'],
            'title' => $this->activity['title'],
            'ticket_id' => $this->id,
        ]);
    }
}
