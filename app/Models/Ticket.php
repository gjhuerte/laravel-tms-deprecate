<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = 'true';
    public $fillable = [

    ];

    public static $statusList = [
        0 => 'Initialized',
        1 => 'Verified',
        4 => 'Assigned',
        5 => 'Waiting for approval',
        5 => 'Approved',
        5 => 'Enqueue',
        6 => 'Resolving',
        7 => 'Resolved',
        8 => 'Waiting for feedback',
        9 => 'Closed'
    ];

    public static function rules()
    {
        return [
            'title' => 'required|max:100',
            'details' => 'required|max:1000',
            'category' => 'required|exists:categories,id',
            'level' => 'required|exists:levels,id',
        ];
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Ticket\Activity', 'ticket_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(__NAMESPACE__ . '\\Tag', 'ticket_tag', 'ticket_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(__NAMESPACE__ . '\\Category', 'category_ticket', 'ticket_id', 'category_id');
    }

    public function personnel()
    {
    	return $this->belongsTo( __NAMESPACE__ . '\\User', 'assigned_to', 'id');
    }

    protected $appends = [
    	'assigned_personnel'
    ];

    public function getAssignedPersonnelAttribute()
    {
    	$fullname = isset($this->personnel) ? $this->personnel->full_name : "None";
    	return $fullname;
    }

    /**
     * Generate initial status for the ticket
     *
     * @return void
     */
    public function generateInitActivity()
    {
        $details = 'The system generated a new ticket from users information';

        $activity = new Ticket\Activity;
        $activity->generateSelfAuthored([
            'ticket_id' => $this->id,
            'details' => $details
        ]);

        return $this;
    }

    /**
     * Require an id and returns the status corresponding to the id given
     *
     * @param [integer] $id
     * @return string $status equivalent to the given id
     */
    public function getStatusById(int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return Ticket::$statusList[$id];
    }

    /**
     * Returns list of all the status the ticket has
     *
     * @return array list of status
     */
    public function getAllStatus()
    {
        return Ticket::$statusList;
    }
}
