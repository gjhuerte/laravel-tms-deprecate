<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketActionService;

class AssignmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TicketService $service, $id)
    {
        $ticket = $service->find($id);

        return view('ticket.assign', compact('ticket'));
    }

    /**
     * Process the data sent by the form
     *
     * @param TicketAssignmentRequest $request
     * @return Response
     */
    public function store(TicketAssignmentRequest $request, TicketActionService $service, $id)
    {
        $service->assign($request->all(), $id);
        
        return redirect()
            ->route('ticket.show', $id)
            ->with('notification', [
                'title' => 'Success!',
                'type' => 'success',
                'message' => 'You have successfully assigned the ticket',
            ]);;
    }
}
