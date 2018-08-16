<?php

namespace App\Http\Controllers\Maintenance;

use Validator;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Managers\Maintenance;
use App\Http\Packages\Object\ObjectParser;

class OrganizationsController extends Maintenance
{
    public $variable = [];

    /**
     * Constructor
     * @param Request $request [description]
     */
    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new Organization;
        $this->parentOrganization = Organization::filterByParent()->whereNull('parent_id')->pluck('name', 'id');

        $this->variable = [
            'indexAjaxUrl' => 'organization',
            'baseUrl' => 'organization',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'Organization',
            'createUrl' => 'organization/create',
            'formBasePath' => 'organization',
            'redirectFailsUrl' => 'organization',
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
                        'placeholder' => 'Enter category name...',
                    ]
                ],
                'abbreviation' => [
                    'dataTableName' => 'abbreviation',
                    'name' => 'Abbreviation',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'abbreviation',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'abbreviation',
                        'placeholder' => 'Enter abbreviation...',
                    ]
                ],
                'parent_id' => [
                    'dataTableName' => 'parent_organization_name',
                    'name' => 'Parent Organization',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => true, 
                    'select' => [
                        'values' => [ null => 'None' ] + $this->parentOrganization->toArray(),
                    ],
                    'attributes' => [
                        'id' => 'parent_organization_name',
                        'class' => 'form-control',
                        'name' => 'parent_id',
                    ]
                ],
            ],
            'fields' => [],
        ];

    	foreach($request->all() as $key => $value) {
    		$this->variable['fields'][$key] =  $value;
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $this->parentOrganization = Organization::filterByParent()->where('id', '!=', $id)->pluck('name', 'id');

        $variable = ObjectParser::make($this->variable);
        $variable->columns->parent_id->select->values = [ null => 'None' ] + $this->parentOrganization->toArray();
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if($validator->fails()) {
            return redirect( $variable->redirectFailsUrl );
        }

        return view($variable->viewBasePath . 'bread.edit')
                ->with('model', $this->class->where('id', '=', $id )->first())
                ->with('variable', $variable);
    }
}
