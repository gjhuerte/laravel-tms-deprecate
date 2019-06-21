<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketActionService;
use App\Http\Resources\Ticket\TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TicketResource $ticket)
    {
        return $ticket->paginate()->transform();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TicketService $service, $id)
    {
        $service->remove($id);

        return response()->json([
            'status' => 'success',
            'title' => 'Operation Success',
            'message' => 'Ticket has been successfully removed',
        ], 200);
    }
}
