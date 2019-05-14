<?php

namespace App\Jobs\Level;

use App\Models\Ticket\Level;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateLevel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    private $level;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->createLevel();

        $this->setSessionMessage();
    }

    /**
     * Create a level
     *
     * @return void
     */
    public function createLevel()
    {
        $request = $this->request;

        $this->level = Level::create([
            'name' => $request['name'],
            'details' => $request['details'],
        ]);
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
            'message' => 'You have successfully created a ticket level',
            'payload' => [
                'level' => $this->level
            ],
        ]);
    }
}
