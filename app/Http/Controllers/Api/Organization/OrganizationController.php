<?php

namespace App\Http\Controllers\Api\Organization;

use Illuminate\Http\Request;
use App\Models\User\Organization;
use App\Http\Controllers\Controller;
use App\Jobs\Organization\RemoveOrganization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::rootOnly()->get();
        
        return datatables($organizations)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RemoveOrganization::dispatch($id);

        return response()->json([
            'status' => 'success',
            'title' => session()->pull('notification.title'),
            'message' => session()->pull('notification.message'),
        ], 200);
    }
}
