<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Models\Ticket\Category;
use App\Http\Controllers\Controller;

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
}
