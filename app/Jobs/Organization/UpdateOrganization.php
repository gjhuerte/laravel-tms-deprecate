<?php

namespace App\Jobs\Organization;

use Illuminate\Bus\Queueable;
use App\Models\User\Organization;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateOrganization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $id;
    protected $organization;

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
        $this->updateOrganization();

        $this->setSessionMessage();
    }

    /**
     * Update organization information
     *
     * @return void
     */
    public function updateOrganization()
    {
        $request = $this->request;

        $this->organization = Organization::findOrFail($this->id);
        $this->organization->update([
            'name' => $request['name'],
            'abbreviation' => $request['abbreviation'],
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
            'message' => 'You have successfully updated an organization',
            'payload' => [
                'organization' => $this->organization
            ],
        ]);
    }
}
