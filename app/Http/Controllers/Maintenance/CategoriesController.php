<?php

namespace App\Http\Controllers\Maintenance;

use App\Models as Model;
use Illuminate\Http\Request;
use App\Http\Managers as Manager;

class CategoriesController extends Manager\Maintenance
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
    	$this->class = new Model\Category;
    	$this->validatorClass = $this->class;

		$this->path = [
	        'create' => 'category/create',
	        'edit' => [
	        	'prefix' => 'category',
	        	'suffix' => 'edit',
	        ],
	        'update' => 'category',
	        'delete' => 'category',
	        'base' => 'category',
	        'view' => 'admin.maintenance',
	        'forms' => [
	            'create' => 'category',
	            'save' => 'category',
	            'edit' => 'category',
	        ],
	        'errors' => [
	            'fails'=> '',
	        ],
	    ];

    	$this->fields = [
    		'name' => [
    			'value' => $request->get('name'),
    			'args' => [
    				'class' => 'form-control',
    				'placeholder' => 'Name'
    			]
    		],
    	];

    	foreach( $request->all() as $key => $value ) {
    		array_push( $this->fields, $key, $value);
    	}
    }
}
