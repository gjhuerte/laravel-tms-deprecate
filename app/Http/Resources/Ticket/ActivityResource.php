<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Activity;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\ActivityTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ActivityResource
{

	private $activity;
	private $hasPaginator = false;
	private $activityCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->activity = new Activity;
	}

	/**
	 * Query to add before or after other queries
	 * depending on the placement
	 * 
	 * @return mixed
	 */
	public function query($query)
	{
		$this->activity = $query($this->activity);

		return $this;
	}


	/**
	 * Filter with ticket
	 * 
	 * @param  integer $id     
	 * @param  callback $queries
	 * @return mixed         
	 */
	public function forTicket($id)
	{
		$this->activity = $this->activity->ticketId($id);

		return $this;
	}

	/**
	 * Paginate the output of activity
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->activity = $this->activity->paginate($count);
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
		$activity = $this->activity;

		if ($this->hasPaginator) {
			$activity = $this->activity->getCollection();
		}

		$this->activityCollection = new Collection(
			$activity, 
			new ActivityTransformer
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
			$output = $this->activityCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->activity)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}
