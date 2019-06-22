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

    /**
     * Checks if the activity is verified
     * 
     * @return boolean 
     */
    public function verifiedCount($ticket = null, $activity = null)
    {
        $activity = $activity ?? new Activity;

        if(isset($ticket)) {
            $id = is_int($ticket) ? $ticket : $ticket->id;

            $activity = $activity->ticketId($id);
        }

        return $activity->verified()->count();
    }

    /**
     * Verified by certain user
     * 
     * @param  integer $ticket  
     * @param  integer $activity
     * @return mixed          
     */
    public function verifiedByUserCount($ticket = null, $activity = null, $user = null)
    {
        $activity = $activity ?? new Activity;
        $user = $user ?? Auth::user();

        if(isset($ticket)) {
            $id = is_int($ticket) ? $ticket : $ticket->id;

            $activity = $activity->ticketId($id);
        }

        return $activity->authorId($user->id)
            ->verified()
            ->count();
    }   
}
