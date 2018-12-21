<?php

namespace App\Jobs\Category;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Category;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateCategory implements ShouldQueue
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
        $request = collect($this->request);

        Category::findOrFail($this->id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent_category'],
        ]);
    }
}
