<?php

namespace App\Http\Controllers\Api\Organization;

use Illuminate\Http\Request;
use App\Models\User\Organization;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\OrganizationResource;
use App\Services\Maintenance\OrganizationService;

class OrganizationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request, 
        OrganizationResource $organization
    ) {

        if ($request->has('parent_id')) {
            $organization = $organization->childOf(
                $request->parent_id
            );

            return $organization
                ->paginate()
                ->transform();
        }

        $organization = $organization->onlyRoot();

        return $organization
            ->paginate()
            ->transform();
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

        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Organization has been removed successfully',
        ], 200);
    }
}
