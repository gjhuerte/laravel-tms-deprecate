<?php

namespace App\Http\Interfaces;

interface UrlCatalog
{
	public function getBasePrefix();
	public function getIndexUrl();
	public function getTicketActivitiesUrl(array $args = []);
	public function getAddActivityUrl(array $args = []);
	public function getAssignStaffUrl(array $args = []);
	public function getClosedUrl(array $args = []);
	public function getReopenUrl(array $args = []);
}