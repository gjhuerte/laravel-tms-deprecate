<?php

namespace App\Transformers\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Level;
use League\Fractal\TransformerAbstract;

class LevelTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the levels
	 * 
	 * @param  Level   $level
	 * @return mixed      
	 */
	public function transform(Level $level)
	{
		$readableCreatedAt = optional($level->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($level->updated_at)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $level->id,
	        'name' => $level->name,
	        'details' => $level->details,
	        'created_at' => $level->created_at,
	        'updated_at' => $level->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        'links' => [
		        'view_url' => route('level.show', $level->id),
		        'edit_url' => route('level.edit', $level->id),
		        'remove_url' => route('api.level.destroy', $level->id),
	        ],
	    ];
	}

}