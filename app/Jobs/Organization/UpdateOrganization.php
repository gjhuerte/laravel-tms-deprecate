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
        $request = $this->request;

        $organization = Organization::findOrFail($this->id);
        $organization->update([
            'name' => $request['name'],
            'abbreviation' => $request['abbreviation'],
        ]);

        session()->flash('notification', [
            'type' => 'success',
            'title' => 'Awesome!',
            'message' => 'You have successfully updated an organization',
            'payload' => [
                'organization' => $organization
            ],
        ]);
    }
}
