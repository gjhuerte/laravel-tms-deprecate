<?php

namespace App\Http\Controllers\Maintenance\User;

use Illuminate\Http\Request;
use App\Jobs\User\ActivateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\UserActivationRequest;

class UserActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenance.user.activate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserActivationRequest $request)
    {
        $this->dispatch(new ActivateUser($request->all()));
        return redirect()->route('user.activate');
    }
}
