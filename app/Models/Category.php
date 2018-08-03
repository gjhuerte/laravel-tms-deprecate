<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $columns = [
        'id' => [
            'save' => false,
            'update' => false,
            'select' => true,
        ],
    	'name' => [
    		'save' => true,
    		'update' => true,
    		'select' => true,
    	],
    ];

    public function insertRules()
    {
    	return [
    		'name' => 'required|min:1',
    	];
    }

    public function updateRules()
    {
    	return [
    		'name' => 'required|min:1',
    	];
    }

    public function checkIfIdExistsRules()
    {
    	return [
    		'id' => "required|exists:$this->table,id",
    	];
    }
}
