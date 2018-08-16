<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
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
    public function getLoginForm(Request $request)
    {
        if(Auth::check()) {
            return redirect('/');
        }

    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$username = filter_var($request->get('username'), FILTER_SANITIZE_STRING);
    	$password = filter_var($request->get('password'), FILTER_SANITIZE_STRING);
        $user = new User;

        $validator = Validator::make($request->all(), $user->loginRules());
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $clientSentUserInformation = [
            'username' => $username,
            'password' => $password
        ];

        /**
         * Check if credentials submitted matched a record 
         * on database. Returns success message if true
         */
        if(Auth::attempt($clientSentUserInformation)) {
            session()->flash('notification', [
                'title' => 'Success!',
                'message' => 'You have created your vehicle',
                'type' => 'success'
            ]);

            return redirect('/');
        }

        session()->flash('notification', [
            'title' => 'Error!',
            'message' => 'Invalid credentials submitted',
            'type' => 'danger'
        ]);

        return back();
    }

    public function logout(Request $request)
    {
        if(Auth::check()) {
            Auth::logout();
        }

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Thank you for using our service!',
            'type' => 'success'
        ]);
        
        return redirect('/');
    }
}
