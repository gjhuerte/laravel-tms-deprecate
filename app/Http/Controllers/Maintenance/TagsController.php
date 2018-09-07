<?php

namespace App\Http\Controllers\Maintenance;

use Validator;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Managers\Maintenance;
use App\Http\Packages\Object\ObjectParser;

class TagsController extends Maintenance
{
    
    /**
     * Constructor
     * @param Request $request [description]
     */
    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new Tag;

        $this->variable = [
            'indexAjaxUrl' => 'tag',
            'baseUrl' => 'tag',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'Tag',
            'createUrl' => 'tag/create',
            'formBasePath' => 'tag',
            'redirectFailsUrl' => 'tag',
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
                'description' => [
                    'dataTableName' => 'description',
                    'name' => 'Descriptions',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'description',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'description',
                        'placeholder' => 'Enter description...',
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
