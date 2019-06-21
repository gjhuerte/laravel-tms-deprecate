<?php

namespace App\Http\Controllers\Maintenance\Ticket;

use App\Models\Ticket\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\Ticket\TagService;
use App\Http\Requests\TicketRequest\TagRequest\TagStoreRequest;
use App\Http\Requests\TicketRequest\TagRequest\TagUpdateRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('maintenance.ticket.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenance.ticket.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request, TagService $service)
    {
        $service->create($request->all());

        return redirect()
            ->route('ticket.tag.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully created a tag',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('maintenance.ticket.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        
        return view('maintenance.ticket.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, TagService $service, $id)
    {
        $service->update($request->all(), $id);

        return redirect()
            ->route('ticket.tag.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully updated a tag',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagService $service, $id)
    {
        $service->remove($id);

        return redirect()
            ->route('ticket.tag.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully removed a tag',
            ]);
    }
}
