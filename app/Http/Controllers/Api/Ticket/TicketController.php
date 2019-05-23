<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\Api\Ticket\CreateTicketWithUser;
use App\Jobs\Api\Ticket\FetchMyAccessibleTicket;
use App\Jobs\Api\Ticket\FetchAllMyAccessibleTicket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->dispatch(new FetchAllMyAccessibleTicket($request->all()));

        return session('notification.payload.tickets');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->dispatch(new CreateTicketWithUser($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->dispatch(new FetchMyAccessibleTicket($id));
    }
}
