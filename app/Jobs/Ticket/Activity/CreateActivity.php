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
        Activity::create([
            'author_id' => $this->request['author_id'] ?? null,
            'details' => $this->request['details'] ?? null,
            'title' => $this->request['title'] ?? null,
            'ticket_id' => $this->id ?? null,
        ]);
    }
}
