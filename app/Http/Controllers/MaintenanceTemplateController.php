<?php

namespace App\Http\Controllers;

use App\Http\Managers;
use Illuminate\Http\Request;

class MaintenanceTemplateController extends MaintenancecManager
{
    protected $viewPath = 'admin.maintenance';
    protected $basePath = '';
    protected $fields = [];
    protected $class;
    protected $validatorClass;
    protected $redirectFailsUrl = '';
    protected $editFormUrl = '';

    public function __construct( Request $request )
    {
    	$this->class = new App\Model\ExampleModel;
    	$this->validatorClass = $this->class;
    	$this->redirectFailsUrl = 'example-url';
    	$this->editFormUrl = 'example-url';
    	$this->basePath = 'example-url';

    	foreach( $request->all() as $key => $value ) {
    		array_push( $this->fields, $key, $value);
    	}
    }
}
