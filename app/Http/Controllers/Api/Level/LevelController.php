<?php

namespace App\Http\Controllers\Api\Level;

use App\Models\Ticket\Level;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\Ticket\LevelService;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::paginate(10);

        return response()->json($levels);
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
