<?php

namespace App\Jobs\Organization;

use Illuminate\Bus\Queueable;
use App\Models\User\Organization;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateOrganization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;
    private $organization;

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
        $this->createOrganization();

        $this->setSessionMessage();
    }

    /**
     * Create an organization
     *
     * @return void
     */
    public function createOrganization()
    {
        $request = $this->request;

        $this->organization = Organization::create([
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
            'message' => 'You have successfully created an organization',
            'payload' => [
                'organization' => $this->organization
            ],
        ]);
    }
}
