<?php

namespace App\Http\Controllers\Maintenance;

use Validator;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Managers\Maintenance;

class UsersController extends Maintenance
{
    
    /**
     * Constructor
     * @param Request $request [description]
     */
    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new User;
        $this->organizations = Organization::pluck('name', 'id');

        $this->variable = [
            'indexAjaxUrl' => 'user',
            'baseUrl' => 'user',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'User',
            'createUrl' => 'user/create',
            'formBasePath' => 'user',
            'redirectFailsUrl' => 'user',
            'isRemovable' => false,
            'columns' => [
                'id' => [
                    'dataTableName' => 'id',
                    'name' => 'ID',
                    'isSelectable' => false,
                    'isInsertable' => false,
                    'isEditable' => false,
                    'selectAttribute' => false, 
                ],
                'username' => [
                    'dataTableName' => 'username',
                    'name' => 'Username',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'username',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'username',
                        'placeholder' => 'Enter username...',
                    ]
                ],
                'lastname' => [
                    'dataTableName' => 'lastname',
                    'name' => 'Lastname',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'lastname',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'lastname',
                        'placeholder' => 'Enter lastname...',
                    ]
                ],
                'firstname' => [
                    'dataTableName' => 'firstname',
                    'name' => 'Firstname',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'firstname',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'firstname',
                        'placeholder' => 'Enter firstname...',
                    ]
                ],
                'middlename' => [
                    'dataTableName' => 'middlename',
                    'name' => 'Middlename',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'middlename',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'middlename',
                        'placeholder' => 'Enter middlename...',
                    ]
                ],
                'email' => [
                    'dataTableName' => 'email',
                    'name' => 'Email',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'email',
                        'type' => 'email',
                        'class' => 'form-control',
                        'name' => 'email',
                        'placeholder' => 'Enter email...',
                    ]
                ],
                'mobile' => [
                    'dataTableName' => 'mobile',
                    'name' => 'Mobile',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'mobile',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'mobile',
                        'placeholder' => 'Enter mobile...',
                    ]
                ],
                'organization' => [
                    'dataTableName' => 'organization_name',
                    'name' => 'Organization',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => true, 
                    'select' => [
                        'values' => [ null => 'None' ] + $this->organizations->toArray(),
                    ],
                    'attributes' => [
                        'id' => 'organization',
                        'class' => 'form-control',
                        'name' => 'organization_id',
                    ]
                ],
                'role' => [
                    'dataTableName' => 'role',
                    'name' => 'Role',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => false, 
                    'attributes' => [
                        'id' => 'role',
                        'type' => 'text',
                        'class' => 'form-control',
                        'name' => 'role',
                        'placeholder' => 'Enter role...',
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
