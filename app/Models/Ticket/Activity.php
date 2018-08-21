<?php

namespace App\Models\Ticket;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'ticket_activities';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $fillable = [
        'title', 'details', 'ticket_id',
    ];

    public function ticket()
    {
        return $this->belongsTo('App\Models\Ticket', 'ticket_id', 'id');
    }

    protected $appends = [
    	'parsed_created_at', 'author_fullname'
    ];

    public function getParsedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * added getter feature for fullname of user who's involved in the activity
     * 
     * @return [string] [fullname]
     */
    public function getAuthorFullnameAttribute()
    {
    	$fullname = isset($this->author) ? $this->author->full_name : "None";
    	return $fullname;
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
        $title = isset($args['title']) ? $args['title'] : 'No title specified.';

        $activity = new Activity;
        $activity->details = $details;
        $activity->authored_by = $authored_by;
        $activity->ticket_id = $ticket_id;
        $activity->title = $title;
        $activity->save();

        return $activity;
    }
}
