<?php

namespace App\Http\Resources\Ticket;

use League\Fractal\Manager;
use App\Models\Ticket\Ticket;
use League\Fractal\Resource\Collection;
use App\Transformers\Ticket\TicketTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TicketResource
{

	private $ticket;
	private $hasPaginator = false;
	private $ticketCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->ticket = new Ticket;
	}

	/**
	 * Paginate the output of ticket
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->ticket = $this->ticket->paginate($count);
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
		$ticket = $this->ticket;

		if ($this->hasPaginator) {
			$ticket = $this->ticket->getCollection();
		}

		$this->ticketCollection = new Collection(
			$ticket, 
			new TicketTransformer
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
			$output = $this->ticketCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->ticket)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}
