<?php

namespace App\Models\Ticket;

use Carbon\Carbon;
use App\Models\User\User;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'ticket_activities';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * Columns used when inserting using create method
     *
     * @var array
     */
    public $fillable = [
        'title', 'details', 'ticket_id',
    ];

    /**
     * Additional columns when querying using eloquent
     *
     * @var array
     */
    protected $appends = [
    	'parsed_created_at', 'author_fullname'
    ];

    /**
     * Parsed date created to make it readable for the system
     * user
     *
     * @return string
     */
    public function getParsedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('M d, Y h:m A');
    }

    /**
     * Fetch the authors full name
     *
     * @return string
     */
    public function getAuthorFullnameAttribute()
    {
    	return isset($this->author) ? $this->author->first_and_last_name : 'System';
    }

    /**
     * Link to ticket model
     *
     * @return object
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    /**
     * Link to user model
     *
     * @return object
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
