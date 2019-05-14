<?php

namespace App\Http\Controllers\Maintenance\User;

use Illuminate\Http\Request;
use App\Jobs\User\ResetPassword;
use App\Http\Controllers\Controller;
use App\Jobs\UserRequest\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenance.user.password_reset');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResetPasswordRequest $request)
    {
        $this->dispatch(new ResetPassword($request->all()));
        return redirect()->route('user.reset_password');
    }
}
