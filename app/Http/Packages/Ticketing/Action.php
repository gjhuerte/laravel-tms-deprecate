<?php

namespace App\Http\Packages\Ticketing;

use Validator;
use App\Models\Ticket as Ticket;
use App\Models\Ticket\Activity as Activity;
use App\Http\Packages\Ticketing\ActionChecker;

trait Action
{

    use ActionChecker;
	/**
	 * Create an activity for initialized ticket
	 * 
	 * @param  int    $id ticket id
	 * @return object     this
	 */
	protected function initialize(array $rawTags = [], array $categories = [])
	{

        $validator = Validator::make([
            'title' => $this->title,
            'details' => $this->details,
            'category' => $this->category,
            'level' => $this->level,
        ], Ticket::rules());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $this->status = $this->getInitializedStatus();
        $this->created_by = Auth::user()->id;
        $this->save();

        $details = 'A new ticket has been generated.';
        $title = 'Ticket Initialization';

        $activity = new Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $id,
        ]);

        if(count($rawTags) <= 0) {

            foreach($rawTags as $rawTags) {   
                $tag = Tag::firstOrCreate([ 'name' => $rawTag ]);
                $tags[] = $tag->id;
            }

            $ticket->tags()->attach($tags);
        }

        if(count($categories) <= 0) {
            $ticket->categories()->attach($category);
        }

        return $this;
	}

	// protected function verify(int $ticketId, int $userId, array $args);
	// protected function requireApproval(int $ticketId);
	// protected function approved(int $ticketId, int $userId);
	// protected function enqueueToStaff(int $ticketId, int $staffId);
	// protected function assign(int $ticketId, int $userId);
	// protected function transfer(int $sourceId, int $destinationId);
	// protected function create(array $args);
	 
	/**
	 * Tags the argument ticket as closed
	 * 
	 * @param  int    $ticketId ticket id to be tagged as closed
	 * @param  string $remarks  additional remarks when closing the ticket
	 * @return pointer reference
	 */
	protected function close(int $ticketId, string $remarks)
	{
        $user = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $details = 'User ' . $user . ' tags the ticket as closed';
        $title = 'Ticket Closing';

        /**
         * tags the ticket as closed
         */
        $this->status = $this->getClosedStatus();
        $this->save();

        $activity = new Ticket\Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $ticketId,
        ]);

        return $this;
	}

	/**
	 * Tags the closed ticket as open
	 * 
	 * @param  int    $ticketId ticket id to be tagged as closed
	 * @param  string $remarks  additional remarks when closing the ticket
	 * @return pointer reference
	 */
	protected function reopen($ticketId, $remarks)
	{
        $user = Auth::user()->firstname . ' ' . Auth::user()->lastname;
        $details = 'User ' . $user . ' reopens the ticket';
        $title = 'Ticket Reopening';

        /**
         * tags the ticket as reopen
         */
        $this->status = $this->getReopenedStatus();
        $this->save();

        $activity = new Ticket\Activity;
        $activity->noAuthor()->generate([
            'title' => $title,
            'details' => $details,
            'ticket_id' => $ticketId,
        ]);

        return $this;
	}

	// protected function resolve(int $ticketId, string $description);
}