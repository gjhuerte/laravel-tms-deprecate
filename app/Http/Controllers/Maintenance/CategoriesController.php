<?php

namespace App\Http\Controllers\Maintenance;

use App\Models as Model;
use Illuminate\Http\Request;
use App\Http\Managers as Manager;

class CategoriesController extends Manager\Maintenance
{

    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new Model\Category;

        $this->variable = [
            'indexAjaxUrl' => 'category',
            'baseUrl' => 'category',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'Category',
            'createUrl' => 'category/create',
            'formBasePath' => 'category',
            'redirectFailsUrl' => 'category',
            'columns' => [
                'id' => [
                    'dataTableName' => 'id',
                    'isSelectable' => true,
                    'isInsertable' => false,
                    'isEditable' => false,
                    'selectAttribute' => false, 
                ],
                'name' => [
                    'dataTableName' => 'name',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'name',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'name',
                        'placeholder' => 'Enter category name...',
                    ]
                ],
            ],
            'fields' => [],
        ];

    	foreach($request->all() as $key => $value) {
    		$this->variable['fields'][$key] =  $value;
    	}
    }
}
