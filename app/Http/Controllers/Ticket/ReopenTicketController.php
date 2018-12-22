<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Jobs\ticket\ReopenTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest\TicketReopenRequest;

class ReopenTicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = Ticket::findOrFail($id);
        return view('ticket.reopen', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketReopenRequest $request, $id)
    {
        $this->dispatch(new ReopenTicket($request->all(), $id));
        return redirect('ticket');
    }
}
