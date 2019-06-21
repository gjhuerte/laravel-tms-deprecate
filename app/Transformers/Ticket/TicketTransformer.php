<?php

namespace App\Transformers\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the ticket
	 * 
	 * @param  Ticket   $ticket
	 * @return mixed      
	 */
	public function transform(Ticket $ticket)
	{
		$readableCreatedAt = optional($ticket->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($ticket->updated_at)->format('M d, Y h:m A');
		$readableDateAssigned = optional($ticket->date_assigned)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $ticket->id,
	        'code' => (int) $ticket->code,
	        'title' => $ticket->title,
	        'details' => $ticket->details,
	        'additional_info' => $ticket->additional_info,
	        'alternative_contact' => $ticket->alt_contact,
	        'assigned_to' => $ticket->assigned_to,
	        'assigned_name' => $ticket->personnel->full_name,
	        'author_id' => $ticket->author_id,
	        'author_name' => optional($ticket->author)->full_name,
	        'parent_id' => $ticket->parent_id,
	        'level_id' => $ticket->level_id,
	        'level' => $ticket->level,
	        'status' => $ticket->status,
	        'date_assigned' => $ticket->date_assigned,
	        'created_at' => $ticket->created_at,
	        'updated_at' => $ticket->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        'human_readable_date_assigned' => $readableDateAssigned,
	        'links' => [
		        'view_url' => route('ticket.show', $ticket->id),
		        'edit_url' => route('ticket.edit', $ticket->id),
		        'remove_url' => route('api.ticket.destroy', $ticket->id),
	        ],
	    ];
	}

}