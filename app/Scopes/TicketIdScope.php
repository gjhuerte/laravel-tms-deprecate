<?php

namespace App\Scopes;

trait TicketIdScope
{

    /**
     * Fetch the ticket id
     *
     * @param  $query
     * @param  integer $id
     * @return void
     */
    public function scopeTicketId($query, $id)
    {
        return $query->where('ticket_id', '=', $id);
    }
}
