<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Level;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\LevelTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class LevelResource
{

	private $level;
	private $hasPaginator = false;
	private $levelCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->level = new Level;
	}

	/**
	 * Paginate the output of level
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->level = $this->level->paginate($count);
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
		$level = $this->level;

		if ($this->hasPaginator) {
			$level = $this->level->getCollection();
		}

		$this->levelCollection = new Collection(
			$level, 
			new LevelTransformer
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
			$output = $this->levelCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->level)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}
