<?php

namespace App\Transformers\Ticket;

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
	    return [
	        'id' => (int) $category->id,
	        'name' => $category->name,
	        'description' => $category->description,
	        'created_at' => $category->created_at,
	        'updated_at' => $category->updated_at,
	        'links' => [
		        'edit_url' => route('category.edit', $category->id),
		        'remove_url' => route('category.destroy', $category->id),
	        ],
	    ];
	}

}