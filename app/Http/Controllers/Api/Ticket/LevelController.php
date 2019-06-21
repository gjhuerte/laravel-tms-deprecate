<?php

namespace App\Http\Controllers\Api\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\LevelResource;
use App\Services\Maintenance\Ticket\LevelService;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, LevelResource $level)
    {
        return $level->paginate()->transform();
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

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Level has been removed successfully',
        ], 200);
    }
}
