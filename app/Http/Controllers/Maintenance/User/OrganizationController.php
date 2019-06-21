<?php

namespace App\Http\Controllers\Maintenance\User;

use Illuminate\Http\Request;
use App\Models\User\Organization;
use App\Http\Controllers\Controller;
use App\Services\Maintenance\OrganizationService;
use App\Http\Requests\OrganizationRequest\OrganizationStoreRequest;
use App\Http\Requests\OrganizationRequest\OrganizationUpdateRequest;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('maintenance.user.organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;
        $organizations = Organization::all();

        if ($request->has('parent_id')) {
            $parent = Organization::findOrFail(
                (int) $request->parent_id
            );
        }

        return view('maintenance.user.organization.create', compact(
            'parent',
            'organizations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationStoreRequest $request, OrganizationService $service)
    {
        $service->create($request->all());

        return redirect()
            ->route('organization.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully created an organization',
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
        $organization = Organization::findOrFail((int) $id);

        return view('maintenance.user.organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OrganizationService $service, $id)
    {
        $organization = Organization::findOrFail((int) $id);
        $organizations = Organization::all();
        $parent = null;
        $parent_id = null;

        if ($request->has('parent_id')) {
            $parent_id = $request->parent_id;
            $parent = Organization::findOrFail(
                (int) $parent_id
            );
        }

        return view('maintenance.user.organization.edit', compact(
            'organization', 
            'organizations', 
            'parent',
            'parent_id'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationUpdateRequest $request, OrganizationService $service, $id)
    {
        $service->update($request->all(), $id);

        return redirect()
            ->route('organization.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully updated an organization',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationService $service, $id)
    {
        $service->remove($id);
        
        return redirect()
            ->route('organization.index')
            ->with('notification', [
                'title' => 'Success',
                'message' => 'You have successfully removed an organization',
            ]);
    }
}
