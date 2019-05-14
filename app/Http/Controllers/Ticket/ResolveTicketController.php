<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Jobs\Ticket\ResolveTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest\TicketResolveRequest;

class ResolveTicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.resolve', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketResolveRequest $request, $id)
    {
        $this->dispatch(new ResolveTicket($request->all(), $id));
        
        return redirect()->route('ticket.show', $id);
    }
}
