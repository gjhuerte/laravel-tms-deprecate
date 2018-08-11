<?php

namespace App\Http\Controllers\Maintenance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
    	return view('admin.maintenance.layout');
    }
}
