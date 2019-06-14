<?php

namespace App\Transformers\Ticket;

use Carbon\Carbon;
use App\Models\Ticket\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

	/**
	 * Formats the output of the categories
	 * 
	 * @param  Category   $category
	 * @return mixed      
	 */
	public function transform(Category $category)
	{
		$readableCreatedAt = optional($category->created_at)->format('M d, Y h:m A');
		$readableUpdatedAt = optional($category->updated_at)->format('M d, Y h:m A');

	    return [
	        'id' => (int) $category->id,
	        'name' => $category->name,
	        'description' => $category->description,
	        'created_at' => $category->created_at,
	        'updated_at' => $category->updated_at,
	        'human_readable_created_at' => $readableCreatedAt,
	        'human_readable_updated_at' => $readableUpdatedAt,
	        'links' => [
		        'view_url' => route('category.show', $category->id),
		        'edit_url' => route('category.edit', $category->id),
		        'remove_url' => route('api.category.destroy', $category->id),
	        ],
	    ];
	}

}