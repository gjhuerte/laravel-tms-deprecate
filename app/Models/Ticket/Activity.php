<?php

namespace App\Models\Ticket;

use Carbon\Carbon;
use App\Models\User\User;
use App\Scopes\TicketIdScope;
use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use TicketIdScope;
    
    protected $table = 'ticket_activities';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * Parse the dates using Carbon package
     * as a date object
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Columns used when inserting using create method
     *
     * @var array
     */
    public $fillable = [
        'title',
        'details',
        'ticket_id',
        'author_id',
    ];

    /**
     * Link to ticket model
     *
     * @return object
     */
    public function ticket()
    {
        return $this->belongsTo(
            Ticket::class, 
            'ticket_id', 
            'id'
        );
    }

    /**
     * Link to user model
     *
     * @return object
     */
    public function author()
    {
        return $this->belongsTo(
            User::class, 
            'author_id', 
            'id'
        );
    }

    /**
     * Filter by ticket id
     *
     * @param Builder $query
     * @param integer $id
     * @return mixed
     */
    public function scopeTicketId($query, $id)
    {
        if (is_array($id)) {
            return $query->whereIn('ticket_id', $id);
        }

        return $query->where('ticket_id', '=', (int) $id);
    }

    /**
     * Get the verified title
     *
     * @param integer $query
     * @return mixed
     */
    public function scopeVerified($query)
    {
        $ticket = new Ticket;

        return $query->where('title', $ticket->getVerifiedTitle());
    }
}
