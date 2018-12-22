<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Jobs\Ticket\AssignTicket;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = Ticket::findOrFail($id);
        return view('ticket.assign', compact('ticket'));
    }

    /**
     * Process the data sent by the form
     *
     * @param TicketAssignmentRequest $request
     * @return Response
     */
    public function store(TicketAssignmentRequest $request, $id)
    {
        $this->dispatch(new AssignTicket($request->all(), $id));
        return redirect('ticket');
    }
}
