<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Level;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public $viewBasePath = 'ticket.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $tickets = Ticket::all();
            return datatables($tickets)->toJson();
        }

        $categories = Category::all();
        $levels = Level::all();
        return view($this->viewBasePath . 'index')
                ->with('categories', $categories)
                ->with('levels', $levels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray() + [null => 'None'];
        $tags = Tag::pluck('name')->toArray();
        $levels = Level::pluck('name')->toArray();
        return view($this->viewBasePath . 'create')
                ->with('categories', $categories)
                ->with('levels', $levels)
                ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
