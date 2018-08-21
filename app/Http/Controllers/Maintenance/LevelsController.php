<?php

namespace App\Http\Controllers\Maintenance;

use Validator;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Managers\Maintenance;
use App\Http\Packages\Object\ObjectParser;

class LevelsController extends Maintenance
{
    public $variable = [];

    /**
     * Constructor
     * @param Request $request [description]
     */
    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new Level;

        $this->variable = [
            'indexAjaxUrl' => 'level',
            'baseUrl' => 'level',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'Level',
            'createUrl' => 'level/create',
            'formBasePath' => 'level',
            'redirectFailsUrl' => 'level',
            'isRemovable' => true,
            'columns' => [
                'id' => [
                    'dataTableName' => 'id',
                    'name' => 'ID',
                    'isSelectable' => true,
                    'isInsertable' => false,
                    'isEditable' => false,
                    'selectAttribute' => false, 
                ],
                'name' => [
                    'dataTableName' => 'name',
                    'name' => 'Name',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'name',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'name',
                        'placeholder' => 'Enter name...',
                    ]
                ],
                'details' => [
                    'dataTableName' => 'details',
                    'name' => 'Details',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'details',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'details',
                        'placeholder' => 'Enter details...',
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
