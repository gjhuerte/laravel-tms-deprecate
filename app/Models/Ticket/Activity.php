<?php

namespace App\Models\Ticket;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'ticket_activities';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }

    /**
     * generate ticket authored by current logged in user
     *
     * @param [array] $args
     * @return object $activity 
     */
    public function generateSelfAuthored(array $args)
    {
        $authored_by = isset($args['authored_by']) ? $args['authored_by'] : Auth::user()->id;
        $details = isset($args['details']) ? $args['details'] : 'No details specified.';
        $ticket_id = isset($args['ticket_id']) ? $args['ticket_id'] : null;

        $activity = new Activity;
        $activity->details = $details;
        $activity->authored_by = $authored_by;
        $activity->ticket_id = $ticket_id;
        $activity->save();

        return $activity;
    }
}
