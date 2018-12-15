<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Jobs\Level\CreateLevel;
use App\Jobs\Level\UpdateLevel;
use App\Jobs\Level\RemoveLevel;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest\LevelStoreRequest;
use App\Http\Requests\LevelRequest\LevelUpdateRequest;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $levels = Level::all();
            return datatables($levels)->toJson();
        }

        return view('maintenance.level.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->route('level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelStoreRequest $request)
    {
        $this->dispatch(new CreateLevel($request->all()));
        return redirect()->route('level.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('maintenance.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LevelUpdateRequest $request, $id)
    {
        $this->dispatch(new UpdateLevel($request->all(), $id));
        return redirect()->route('level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new RemoveLevel($id));
        return redirect()->route('level.index');
    }
}
