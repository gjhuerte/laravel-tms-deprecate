<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Jobs\Ticket\VerifyTicket;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest\TicketVerificationRequest;

class VerificationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.transfer', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketVerificationRequest $request, $id)
    {
        $this->dispatch(new VerifyTicket($request->all(), $id));
        return redirect('ticket');
    }
}
