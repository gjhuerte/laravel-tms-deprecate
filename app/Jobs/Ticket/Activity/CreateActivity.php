<?php

namespace App\Jobs\Ticket\Activity;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $author_id = isset($args['author_id']) ? $args['author_id'] : $this->author_id;
        $details = isset($args['details']) ? $args['details'] : 'No details specified.';
        $ticket_id = isset($args['ticket_id']) ? $args['ticket_id'] : null;
        $title = isset($args['title']) ? $args['title'] : 'No title specified.';

        $activity = new Activity;
        $activity->details = $details;
        $activity->author_id = $author_id;
        $activity->ticket_id = $ticket_id;
        $activity->title = $title;
        $activity->save();

        return $activity;
    }
}
