<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Tag;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\TagTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TagResource
{

	private $tag;
	private $hasPaginator = false;
	private $tagCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->tag = new Tag;
	}

	/**
	 * Paginate the output of tag
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->tag = $this->tag->paginate($count);
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
		$tag = $this->tag;

		if ($this->hasPaginator) {
			$tag = $this->tag->getCollection();
		}

		$this->tagCollection = new Collection(
			$tag, 
			new TagTransformer
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
			$output = $this->tagCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->tag)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}
