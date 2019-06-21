<?php

namespace App\Http\Controllers\Maintenance\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\User\Organization;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\UserService;
use App\Http\Requests\UserRequest\UserStoreRequest;
use App\Http\Requests\UserRequest\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('maintenance.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();

        return view('maintenance.user.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request, UserService $service)
    {
        $service->create($request->all());

        return redirect()
            ->route('user.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully created a user',
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
        $user = User::findOrFail($id);
        return view('maintenance.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $organizations = Organization::all();

        return view('maintenance.user.edit', compact(
            'user',
            'organizations'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, UserService $service, $id)
    {
        $service->update($request->all(), $id);

        return redirect()
            ->route('user.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully updated a user',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserService $service, $id)
    {
        $service->remove($id);

        return redirect()
            ->route('user.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully removed a user',
            ]);
    }
}
