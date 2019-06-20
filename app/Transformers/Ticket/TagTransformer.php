<?php

namespace App\Transformers\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the categories
	 * 
	 * @param  Tag   $tag
	 * @return mixed      
	 */
	public function transform(Tag $tag)
	{
		$readableCreatedAt = optional($tag->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($tag->updated_at)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $tag->id,
	        'name' => $tag->name,
	        'description' => $tag->description,
	        'created_at' => $tag->created_at,
	        'updated_at' => $tag->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        'links' => [
		        'view_url' => route('ticket.tag.show', $tag->id),
		        'edit_url' => route('ticket.tag.edit', $tag->id),
		        'remove_url' => route('api.ticket.tag.destroy', $tag->id),
	        ],
	    ];
	}

}