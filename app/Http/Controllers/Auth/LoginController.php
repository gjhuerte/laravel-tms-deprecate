<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

	public function __construct()
	{
		if(Auth::check()) {
			return redirect('dashboard');
		}
	}

	/**
	 * Fetches the form for the login
	 * @param  Request $request 
	 * @return form blade
	 */
    public function form(Request $request)
    {
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$username = filter_var($request->get('username'), FILTER_SANITIZE_STRING);
    	$password = filter_var($request->get('password'), FILTER_SANITIZE_STRING);
    	
		session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'You have created your vehicle',
            'type' => 'success'
        ]);

    	return redirect('/');
    }
}
