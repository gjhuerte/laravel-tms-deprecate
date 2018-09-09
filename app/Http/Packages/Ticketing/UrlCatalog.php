<?php

namespace App\Http\Packages\Ticketing;

use App\Http\Interfaces\UrlCatalog as UrlCatalogInterface;

trait UrlCatalog
{

	/**
	 * Returns the string for base prefix
	 * 
	 * @return string url prefix
	 */
	public function getBasePrefix()
	{
		return 'ticket';
	}

	/**
	 * Returns the url for ticket index
	 * 
	 * @return string url
	 */
	public function getIndexUrl()
	{
		return 'ticket';
	}

	/**
	 * Returns the url for list of activities 
	 * under a ticket
	 * 
	 * @param  Array $args Argument list
	 * @return String url
	 */
	public function getTicketActivitiesUrl(array $args = [])
	{
		if(isset($this->id) && $this->id) {
			return url('ticket/' . $this->id);
		} else if(isset($args['routeAvailability']) && $args['routeAvailability']) {
			return url('ticket/{id}');
		}
	}

	/**
	 * Returns the url for adding an activity
	 * 
	 * @param  Array $args Argument list
	 * @return String url
	 */
	public function getAddActivityUrl(array $args = [])
	{
		if(isset($this->id) && $this->id) {
			return "ticket/$this->id/activity/add";
		} else if(isset($args['routeAvailability']) && $args['routeAvailability']) {
			return 'ticket/{id}/activity/add';
		}
	}

	/**
	 * Returns the url for assigning staff
	 * 
	 * @param  Array $args Argument list
	 * @return String url
	 */
	public function getAssignStaffUrl(array $args = [])
	{
		if(isset($this->id) && $this->id) {
			return "ticket/$this->id/transfer";
		} else if(isset($args['routeAvailability']) && $args['routeAvailability']) {
			return 'ticket/{id}/transfer';
		}
	}

	/**
	 * Returns the url for closing ticket
	 * 
	 * @param  Array $args Argument list
	 * @return String url
	 */
	public function getClosedUrl(array $args = [])
	{
		if(isset($this->id) && $this->id) {
			return "ticket/$this->id/close";
		} else if(isset($args['routeAvailability']) && $args['routeAvailability']) {
			return 'ticket/{id}/close';
		}
	}

	/**
	 * Returns the url for closing ticket
	 * 
	 * @param  Array $args Argument list
	 * @return String url
	 */
	public function getReopenUrl(array $args = [])
	{
		if(isset($this->id) && $this->id) {
			return "ticket/$this->id/reopen";
		} else if(isset($args['routeAvailability']) && $args['routeAvailability']) {
			return 'ticket/{id}/reopen';
		}
	}
}