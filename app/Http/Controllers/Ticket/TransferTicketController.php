<?php

namespace App\Http\Controllers\Ticket;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketActionService;
use App\Http\Requests\TicketRequest\TicketTransferRequest;

class TransferTicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TicketService $service, $id)
    {
        $ticket = $service->find($id);
        $users = User::all();

        return view('ticket.transfer', compact('ticket', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(TicketTransferRequest $request, TicketActionService $service, $id)
    {
        $service->transfer($request->all(), $id);

        return redirect()
            ->route('ticket.show', $id)
            ->with('notification', [
                'title' => 'Success!',
                'message' => 'The ticket has been transferred successfully',
            ]);;
    }
}
