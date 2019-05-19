<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Activity;
use App\Http\Controllers\Controller;
use App\Jobs\Api\Ticket\Activity\CreateActivity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activities, $id = null)
    {
        $activities->with(['author']);
        if(isset($id)) { 
            $activities->ticketId((int) $id);
        }
    
        return datatables($activities->get())->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->dispatch(new CreateActivity($request));
    }
}
