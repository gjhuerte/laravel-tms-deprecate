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

    private $request;
    private $id;
    private $category;

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
        $this->updateCategory();

        $this->setSessionMessage();
    }

    /**
     * Update category
     *
     * @return void
     */
    public function updateCategory()
    {
        $request = $this->request;
        $this->category = Category::findOrFail($this->id);

        $this->category->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'parent_id' => $request['parent_category'] ?? null,
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
            'message' => 'You have successfully updated a ticket category',
            'payload' => [
                'category' => $this->category
            ],
        ]);
    }
}
