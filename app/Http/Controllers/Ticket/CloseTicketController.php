<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Jobs\Ticket\CloseTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest\TicketCloseRequest;

class CloseTicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.close', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCloseRequest $request, $id)
    {
        $this->dispatch(new CloseTicket($request->all(), $id));
        
        return redirect()->route('ticket.show', $id);
    }
}
