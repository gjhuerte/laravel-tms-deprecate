<?php

namespace App\Jobs\Ticket\Tag;

use App\Models\Ticket\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ticket;
    protected $request;
    protected $tags = [];
    protected $tagsModel = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $ticket = null)
    {
        $this->request = $request;
        $this->ticket = $ticket;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->splitTags();

        $this->createTags();

        $this->assignTagsToTicket();

        $this->setSessionMessage();
    }

    /**
     * Create an array from string request
     *
     * @return void
     */
    public function splitTags()
    {
        $this->tags = explode(',', $this->request);

        return;
    }

    /**
     * Create a list of tags and assign to the ticket
     *
     * @return void
     */
    public function createTags()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $this->tagsModel[] = Tag::firstOrCreate(['name' => $tag]);
        }

        return;
    }

    /**
     * Assign tags to ticket if ticket exists
     *
     * @return void
     */
    public function assignTagsToTicket()
    {
        if (isset($this->ticket)) {
            $this->ticket
                ->tags()
                ->saveMany($this->tagsModel);
        }

        return;
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
            'message' => 'You have successfully created a ticket tag',
            'payload' => [
                'tags' => $this->tags,
                'ticket' => $this->ticket,
            ]
        ]);
    }
}
