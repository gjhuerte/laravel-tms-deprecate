<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Models\User\Organization;
use App\Http\Controllers\Controller;
use App\Jobs\Organization\CreateOrganization;
use App\Jobs\Organization\UpdateOrganization;
use App\Jobs\Organization\RemoveOrganization;
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
        return view('maintenance.organization.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;
        if ($request->has('parent_id')) {
            $parent = Organization::findOrFail((int) $request->parent_id);
        }

        return view('maintenance.organization.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationStoreRequest $request)
    {
        $this->dispatch(new CreateOrganization($request->all()));

        return redirect()->route('organization.index');
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

        return view('maintenance.organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail((int) $id);
        $parent = null;
        if ($request->has('parent_id')) {
            $parent = Organization::findOrFail((int) $request->parent_id);

            return view('maintenance.organization.create');
        }

        return view('maintenance.organization.edit', compact('organization', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationUpdateRequest $request, $id)
    {
        $this->dispatch(new UpdateOrganization($request->all(), $id));

        return redirect()->route('organization.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new RemoveOrganization($id));
        
        return redirect()->route('organization.index');
    }
}
