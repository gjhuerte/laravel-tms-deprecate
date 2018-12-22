<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Jobs\Api\Ticket\CreateTicketWithUser;
use App\Jobs\Api\Ticket\FetchMyAccessibleTicket;
use App\Jobs\Api\Ticket\FetchAllMyAccessibleTicket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dispatch(new FetchAllMyAccessibleTicket());
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
