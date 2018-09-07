<?php

namespace App\Http\Controllers\Ticketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionsController extends Controller
{

    /**
     * Returns form for creating action on a 
     * ticket
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        return view('ticket.action.create');
    }

    /**
     * Process the action created
     *
     * @param Request $request
     * @return void
     */
    public function process(Request $request)
    {
        return redirect('ticket/create');
    }
}
