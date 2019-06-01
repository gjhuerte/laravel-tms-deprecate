<?php

namespace App\Services\Ticket;

use App\Services\BaseService;
use App\Models\Ticket\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityService extends BaseService
{

    /**
     * Create a new activity
     *
     * @param array $attributes
     * @param double $ticketId
     * @return mixed
     */
    public function create($attributes, $ticketId)
    {
        
        $activity = Activity::create([
            'author_id' => $attributes['author_id'] ?? null,
            'details' => $attributes['details'] ?? null,
            'title' => $attributes['title'] ?? null,
            'ticket_id' => $ticketId ?? null,
        ]);

        return $activity;
    }

    /**
     * Create a new self authored ticket activity
     *
     * @param array $attributes
     * @param double $ticketId
     * @return mixed
     */
    public function createSelfAuthored($attributes, $ticketId)
    {
        $authorId = Auth::id();
        $attributes = array_merge((array) $attributes, [
            'author_id' => $authorId
        ]);

        return $this->create($attributes, $ticketId);
    }
}
