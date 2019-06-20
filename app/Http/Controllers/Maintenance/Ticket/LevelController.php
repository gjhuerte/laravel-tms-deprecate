<?php

namespace App\Http\Controllers\Maintenance\Ticket;

use App\Models\Ticket\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\Ticket\LevelService;
use App\Http\Requests\LevelRequest\LevelStoreRequest;
use App\Http\Requests\LevelRequest\LevelUpdateRequest;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('maintenance.ticket.level.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenance.ticket.level.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level = Level::findOrFail($id);

        return view('maintenance.ticket.level.show', compact('level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelStoreRequest $request, LevelService $service)
    {
        $service->create($request->all());

        return redirect()->route('level.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::findOrFail($id);

        return view('maintenance.ticket.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LevelUpdateRequest $request, LevelService $service, $id)
    {
        $service->update($request->all(), $id);

        return redirect()->route('level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelService $service, $id)
    {
        $service->remove($id);

        return redirect()->route('level.index');
    }
}
