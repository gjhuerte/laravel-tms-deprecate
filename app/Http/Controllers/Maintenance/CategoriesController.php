<?php

namespace App\Http\Controllers\Maintenance;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Managers\Maintenance;
use App\Http\Packages\Object\ObjectParser;

class CategoriesController extends Maintenance
{

    /**
     * Constructor
     * @param Request $request [description]
     */
    public function __construct( Request $request )
    {
    	$this->validatorClass = $this->class = new Category;
        $this->parentCategories = Category::filterByParent()->whereNull('parent_id')->pluck('name', 'id');

        $this->variable = [
            'indexAjaxUrl' => 'category',
            'baseUrl' => 'category',
            'viewBasePath' => 'admin.maintenance.',
            'title' => 'Category',
            'createUrl' => 'category/create',
            'formBasePath' => 'category',
            'redirectFailsUrl' => 'category',
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
                'parent_id' => [
                    'dataTableName' => 'parent_category_name',
                    'name' => 'Parent Category',
                    'isSelectable' => true,
                    'isInsertable' => true,
                    'isEditable' => true,
                    'selectAttribute' => true, 
                    'select' => [
                        'values' => [ null => 'None' ] + $this->parentCategories->toArray(),
                    ],
                    'attributes' => [
                        'id' => 'parent_category_name',
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
        $this->parentCategories = Category::filterByParent()->where('id', '!=', $id)->pluck('name', 'id');

        $variable = ObjectParser::make($this->variable);
        $variable->columns->parent_id->select->values = [ null => 'None' ] + $this->parentCategories->toArray();
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {
            return redirect( $variable->redirectFailsUrl );
        }

        return view( $variable->viewBasePath . 'bread.edit')
                ->with('model', $this->class->whereNull('parent_id')->where('id', '=', $id )->first())
                ->with('variable', $variable);
    }
}
