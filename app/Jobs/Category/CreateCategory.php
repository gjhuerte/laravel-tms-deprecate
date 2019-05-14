<?php

namespace App\Jobs\Category;

use Illuminate\Bus\Queueable;
use App\Models\Ticket\Category;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $category;

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
        $this->createCategory();

        $this->setSessionMessage();
    }

    /**
     * Create a category
     *
     * @return void
     */
    public function createCategory()
    {
        $request = $this->request;
        
        $this->category = Category::create([
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
            'message' => 'You have successfully created a ticket category',
            'payload' => [
                'category' => $this->category
            ],
        ]);
    }
}
