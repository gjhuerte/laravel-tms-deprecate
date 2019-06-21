<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Category;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\CategoryTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CategoryResource
{

	private $category;
	private $hasPaginator = false;
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
		$this->hasPaginator = true;

		return $this;
	}


	/**
	 * Create a new  collection
	 * 
	 * @return mixed
	 */
	public function createCollection()
	{
		$category = $this->category;

		if ($this->hasPaginator) {
			$category = $this->category->getCollection();
		}

		$this->categoryCollection = new Collection(
			$category, 
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

		if($this->hasPaginator) {
			$output = $this->categoryCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->category)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}
