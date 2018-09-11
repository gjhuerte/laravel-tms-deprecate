<?php

namespace App\Models;

use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Packages\Ticketing\Status;
use App\Http\Packages\Ticketing\Action;
use App\Http\Packages\Ticketing\UrlCatalog;

class Ticket extends Model
{

    use Action;
    use Status;
    use UrlCatalog;

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
    public $fillable = [];

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

    public function author()
    {
    	return $this->belongsTo( __NAMESPACE__ . '\\User', 'author_id', 'id');
    }

    protected $appends = [
    	'assigned_personnel'
    ];

    public function getAssignedPersonnelAttribute()
    {
    	$fullname = isset($this->personnel) ? $this->personnel->full_name : "None";
    	return $fullname;
    }

    public function basicIdValidation()
    {

        $validator = Validator::make(['ticket' => $this->id], [
            'ticket' => 'required|exists:tickets,id',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    }

    public function basicIdValidationWithUser()
    {
        $args = [
            'ticket' => $this->id,
            'user' => $this->user_id,
        ];

        $validator = Validator::make($args, [
            'ticket' => 'required|exists:tickets,id',
            'user' => 'required|exists:user,id',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
    }
}
