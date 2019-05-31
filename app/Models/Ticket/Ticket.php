<?php

namespace App\Models\Ticket;

use app\Models\User\User;
use App\Models\Ticket\Tag;
use App\Scopes\StatusScope;
use Auxilliary\Generator\Code;
use Illuminate\Support\Carbon;
use App\Models\Ticket\Activity;
use App\Models\Ticket\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{

    use StatusScope, SoftDeletes;

    const INITIALIZED = 'Initialized';
    const VERIFIED = 'Verified';
    const ASSIGNED = 'Assigned';
    const TRANSFERRED = 'Transferred';
    const WAITINGFORAPPROVAL = 'Waiting for approval';
    const APPROVED = 'Approved';
    const ENQUEUE = 'Enqueue';
    const RESOLVING = 'Resolving';
    const RESOLVED = 'Resolved';
    const WAITINGFORFEEDBACK = 'Waiting for feedback';
    const CLOSED = 'Closed';
    const REOPENED = 'Reopened';

    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = 'true';

    /**
     * Columns used when inserting to database using
     * the create function of model
     *
     * @var array
     */
    public $fillable = [
        'code',
        'title',
        'details',
        'alt_contact',
        'additional_info',
        'assigned_to',
        'created_by',
        'author_id',
        'parent_id',
        'date_assigend',
        'level_id',
        'status',
    ];

    /**
     * Additional columns when querying using eloquent model
     *
     * @var array
     */
    protected $appends = [
        'assigned_personnel',
        'author_name'
    ];

    /**
     * Fetch the assigned personnel from the personnels table
     *
     * @return string
     */
    public function getAssignedPersonnelAttribute()
    {
        return isset($this->personnel) ? $this->personnel->full_name : 'None';
    }

    /**
     * Fetch authors full name
     *
     * @return string
     */
    public function getAuthorNameAttribute()
    {
        return isset($this->author) ? $this->author->full_name : 'None';
    }

    /**
     * Generate a ticket code
     *
     * @return string
     */
    public function generateCode()
    {
        $date = Carbon::now()->format('m-y');
        $count = (new self)->onCurrentMonth()->count() + 1;

        return Code::make([
            $date, $count
        ]);
    }

    /**
     * Link to activities table
     *
     * @return object
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'ticket_id', 'id');
    }

    /**
     * Link to tags table
     *
     * @return object
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ticket_tag', 'ticket_id', 'tag_id');
    }

    /**
     * Link to categories table
     *
     * @return object
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_ticket', 'ticket_id', 'category_id');
    }

    /**
     * Link to personnels table
     *
     * @return object
     */
    public function personnel()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    /**
     * Link to authors table
     *
     * @return object
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /**
     * Fetch the tickets for current month
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeOnCurrentMonth($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ]);
    }
}
