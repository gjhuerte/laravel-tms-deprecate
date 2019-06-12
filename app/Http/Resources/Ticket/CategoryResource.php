<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Category;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\CategoryTransformer;
use League\Fractal\Serializer\DataArraySerializer;

class CategoryResource
{

	private $category;
	private $categoryCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->category = new Category;
	}

	/**
	 * Paginate the output of category
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->category = $this->category->paginate($count);

		return $this;
	}

	public function createCollection()
	{
		$this->categoryCollection = new Collection(
			$this->category, 
			new CategoryTransformer
		);

		return $this;
	}

	/**
	 * Return the output as API
	 * 
	 * @return object
	 */
	public function transform()
	{
		$this->createCollection();

		$output = $this->manager
			->createData($this->categoryCollection)
			->toJson();

		return $output;
	}
}
