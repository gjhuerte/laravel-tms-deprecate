<?php

namespace App\Jobs\Level;

use App\Models\Ticket\Level;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLevel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $id;
    private $level;

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
        $this->updateLevel();

        $this->setSessionMessage();
    }

    /**
     * Update level
     *
     * @return void
     */
    public function updateLevel()
    {
        $request = $this->request;

        $this->level = Level::findOrFail($this->id);
        $this->level->update([
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
