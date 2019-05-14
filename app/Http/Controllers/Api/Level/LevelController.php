<?php

namespace App\Http\Controllers\Api\Level;

use Illuminate\Http\Request;
use App\Models\Ticket\Level;
use App\Jobs\Level\RemoveLevel;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        return datatables($levels)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RemoveLevel::dispatch($id);

        return response()->json([
            'status' => 'success',
            'title' => session()->pull('notification.title'),
            'message' => session()->pull('notification.message'),
        ], 200);
    }
}
