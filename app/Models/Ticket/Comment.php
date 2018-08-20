<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'ticket_comments';
    protected $primaryKey = 'id';
}
