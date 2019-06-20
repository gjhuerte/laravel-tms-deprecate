<?php

namespace App\Http\Controllers\Api\Ticket\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ticket\TagResource;
use App\Services\Maintenance\Ticket\TagService;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TagResource $tag)
    {
        return $tag->paginate()->transform();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TagService $service, $id)
    {
        $service->remove($id);

        return response()->json([
            'status' => 'success',
            'title' => 'Operation Success',
            'message' => 'Tag has been removed',
        ], 200);
    }
}
