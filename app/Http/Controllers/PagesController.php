<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	/**
	 * returns the view for dashboard
	 * @return view dashboard blade template
	 */
    public function getDashboard()
    {
    	if(Auth::check()) {
    		return view('dashboard.base-layout');
    	}

    	return redirect('login');
    }
}
