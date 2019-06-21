<?php

namespace App\Http\Controllers\Maintenance\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Category;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\Ticket\CategoryService;
use App\Http\Requests\CategoryRequest\CategoryStoreRequest;
use App\Http\Requests\CategoryRequest\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('maintenance.ticket.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenance.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request, CategoryService $service)
    {
        $service->create($request->all());

        return redirect()
            ->route('category.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully created a category',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('maintenance.ticket.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        return view('maintenance.ticket.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, CategoryService $service, $id)
    {
        $service->update($request->all(), $id);

        return redirect()
            ->route('category.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully updated a category',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryService $service, $id)
    {
        $service->remove($id);

        return redirect()
            ->route('category.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully removed a category',
            ]);
    }
}
