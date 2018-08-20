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
    public $baseUrl = 'ticket';

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
        $url = filter_var($request->get('url'), FILTER_SANITIZE_URL);
        $title = filter_var($request->get('title'), FILTER_SANITIZE_STRING);
        $contact = filter_var($request->get('contact'), FILTER_SANITIZE_STRING);
        $level = filter_var($request->get('level'), FILTER_SANITIZE_NUMBER_INT);
        $categories = filter_var($request->get('categories'), FILTER_SANITIZE_NUMBER_INT);
        $details = strip_tags($request->get('details'), '<h1><h2><h3><h4><h5><p><span><ol><ul><li><a><br>');

        $validator = Validator::make([
            'title' => $title,
            'details' => $details,
            'category' => $category,
            'level' => $level,
        ], Ticket::rules());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $ticket = new Ticket;
        $ticket->title = $title;
        $ticket->details = $details;
        $ticket->alt_contact = $contact;
        $ticket->status = 'Initialized';
        $ticket->created_by = Auth::user()->id;
        $ticket->generateInitActivity();
        $ticket->tags->attach($tags);
        $ticket->category->attach();
        $ticket->save();

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Ticket successfully generated',
            'type' => 'success'
        ]);

        return redirect($this->baseUrl);
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
