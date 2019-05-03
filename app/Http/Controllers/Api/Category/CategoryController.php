<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Models\Ticket\Category;
use App\Http\Controllers\Controller;
use App\Jobs\Category\RemoveCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return datatables($categories)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RemoveCategory::dispatch($id);

        return response()->json([
            'status' => 'success',
            'title' => session()->pull('notification.title'),
            'message' => session()->pull('notification.message'),
        ], 200);
    }
}
