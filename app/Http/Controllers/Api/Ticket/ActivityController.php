<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Activity;
use App\Http\Controllers\Controller;
use App\Services\Ticket\ActivityService;
use App\Http\Resources\Ticket\ActivityResource;
use App\Jobs\Api\Ticket\Activity\CreateActivity;

class ActivityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ActivityResource $activity, $id)
    {
        $activity = $activity->query(function ($query) use($id) {
                return $query->with(['author']);
            })
            ->forTicket($id)
            ->query(function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->paginate()
            ->transform();

        return $activity;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ActivityService $service)
    {
        $service->create($request->all(), null);

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Ticket activity created successfully',
        ], 200);
    }
}
