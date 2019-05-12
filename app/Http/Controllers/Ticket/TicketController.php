<?php

namespace App\Http\Controllers\Ticket;

use App\Models\Ticket\Tag;
use App\Models\Ticket\Level;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Category;
use App\Jobs\Ticket\UpdateTicket;
use App\Http\Controllers\Controller;
use App\Jobs\Ticket\InitializeTicket;
use App\Http\Requests\TicketRequest\TicketStoreRequest;
use App\Http\Requests\TicketRequest\TicketUpdateRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $status = Ticket::pluck('status')->unique();
        $levels = Level::all();

        return view('ticket.index')
                    ->with('categories', $categories)
                    ->with('status', $status)
                    ->with('levels', $levels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name')->toArray();

        return view('ticket.create')
            ->with('levels', $levels)
            ->with('tags', $tags)
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStoreRequest $request)
    {
        $this->dispatch(new InitializeTicket($request->all()));

        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketUpdateRequest $request, $id)
    {
        $this->dispatch(new UpdateTicket($request->all(), $id));
        
        return redirect()->route('ticket.index');
    }
}
