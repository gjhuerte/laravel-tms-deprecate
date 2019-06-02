<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Models\Ticket\Category;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\Ticket\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
    public function destroy(Request $request, CategoryService $service, $id)
    {
        $service->remove($id);

        return response()->json([
            'status' => 'success',
            'title' => 'Operation Success',
            'message' => 'Category has been removed',
        ], 200);
    }
}
