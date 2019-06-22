<?php

namespace App\Transformers\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Activity;
use League\Fractal\TransformerAbstract;

class ActivityTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the activity
	 * 
	 * @param  Activity   $activity
	 * @return mixed      
	 */
	public function transform(Activity $activity)
	{
		$readableCreatedAt = optional($activity->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($activity->updated_at)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $activity->id,
	        'title' => $activity->title,
	        'details' => $activity->details,
	        'name' => $activity->name,
	        'author_id' => $activity->user_id,
	        'author_name' => optional($activity->author)->full_name,
	        'created_at' => $activity->created_at,
	        'updated_at' => $activity->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        // 'links' => [
		        // 'view_url' => route('activity.show', $activity->id),
		        // 'edit_url' => route('activity.edit', $activity->id),
		        // 'remove_url' => route('api.activity.destroy', $activity->id),
	        // ],
	    ];
	}

}