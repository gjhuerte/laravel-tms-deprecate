<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Validator;
use App\Models\Tag;
use App\Models\Level;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Packages\Tag\TagManager;

class TicketsController extends Controller
{
    public $viewBasePath = 'ticket';
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
        $status = Ticket::$statusList;
        return view($this->viewBasePath . '.index')
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
        $categories = Category::pluck('name', 'id')->toArray();
        $tags = Tag::pluck('name')->toArray();
        $levels = Level::pluck('name')->toArray();
        return view($this->viewBasePath . '.create')
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
        $category = filter_var($request->get('category'), FILTER_SANITIZE_NUMBER_INT);
        $details = strip_tags($request->get('details'), '<h1><h2><h3><h4><h5><p><span><ol><ul><li><a><br>');
        $rawTags = TagManager::sanitize($request->get('tags'));

        DB::beginTransaction();

        $ticket = new Ticket;
        $ticket->title = $title;
        $ticket->details = $details;
        $ticket->alt_contact = $contact;
        $ticket->initialize($rawTags, $categories);

        DB::commit();

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
    public function show(Request $request, $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $ticket = Ticket::with(['categories', 'tags'])->find($id);
        $ticket->basicIdValidation();

        if($request->ajax()) {
            return datatables($ticket->activities->sortByDesc('parsed_created_at'))->toJson();
        }

        return view($this->viewBasePath . '.show')
                ->with('ticket', $ticket);
    }

    /**
     * close ticket functionality
     * @param  Request $request [request]
     * @param  [int]  $id      [ticket id]
     * @return [type]           [description]
     */
    public function close(Request $request, int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $ticket = Ticket::find($id);
        $ticket->basicIdValidation();
        $ticket->close();

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Ticket successfully closed',
            'type' => 'success'
        ]);

        return redirect($this->baseUrl);
    }

    /**
     * reopen ticket functionality
     * @param  Request $request [request]
     * @param  [int]  $id      [ticket id]
     * @return [type]           [description]
     */
    public function reopen(Request $request, int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $ticket = Ticket::find($id);
        $ticket->basicIdValidation();
        $ticket->reopen();

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Ticket successfully reopened',
            'type' => 'success'
        ]);

        return redirect($this->baseUrl);
    }

    /**
     * assign ticket functionality
     * @param  Request $request [request]
     * @param  [int]  $id      [ticket id]
     * @return [type]           [description]
     */
    public function assign(Request $request, int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $userId = filter_var($request->get('user'), 'FILTER_SANITIZE_NUMBER_INT');
        $ticket = Ticket::find($id);
        $ticket->user_id = $userId;
        $ticket->basicIdValidationWithUser();
        $ticket->assign();

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Ticket successfully reopened',
            'type' => 'success'
        ]);

        return redirect($this->baseUrl);
    }
}
