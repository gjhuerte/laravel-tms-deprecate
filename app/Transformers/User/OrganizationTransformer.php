<?php

namespace App\Transformers\User;

use Carbon\Carbon;
use App\Models\User\Organization;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the levels
	 * 
	 * @param  Organization   $organization
	 * @return mixed      
	 */
	public function transform(Organization $organization)
	{
		$readableCreatedAt = optional($organization->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($organization->updated_at)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $organization->id,
	        'name' => $organization->name,
	        'parent_id' => $organization->parent_id,
	        'parent' => $organization->parent,
	        'abbreviation' => $organization->abbreviation,
	        'created_at' => $organization->created_at,
	        'updated_at' => $organization->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        'links' => [
		        'view_url' => route('organization.show', $organization->id),
		        'edit_url' => route('organization.edit', $organization->id),
		        'remove_url' => route('api.organization.destroy', $organization->id),
	        ],
	    ];
	}

}