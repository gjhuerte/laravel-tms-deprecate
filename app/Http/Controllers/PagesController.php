<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	/**
	 * returns the view for dashboard
	 * @return view dashboard blade template
	 */
    public function getDashboard()
    {
    	return view('dashboard.base-layout');
    }
}
