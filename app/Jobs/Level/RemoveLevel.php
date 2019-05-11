<?php

namespace App\Jobs\Level;

use App\Models\Ticket\Level;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoveLevel implements ShouldQueue
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
        $this->removeLevel();

        $this->setSessionMessage();
    }

    /**
     * Remove a level
     *
     * @return void
     */
    public function removeLevel()
    {
        Level::findOrFail($this->id)->delete();
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
            'message' => 'You have successfully removed a ticket level',
        ]);
    }
}
