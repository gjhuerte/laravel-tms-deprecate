<?php

namespace App\Jobs\Organization;

use Illuminate\Bus\Queueable;
use App\Models\User\Organization;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoveOrganization implements ShouldQueue
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
        $this->removeOrganization();

        $this->setSessionMessage();
    }

    /**
     * Remove an organization
     *
     * @return void
     */
    public function removeOrganization()
    {
        Organization::findOrFail($this->id)->delete();
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
            'message' => 'You have successfully removed an organization',
        ]);
    }
}
