<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
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
        'details' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
    ];

    public function insertRules()
    {
    	return [
    		'name' => 'required|min:1|unique:' . $this->table . ',name',
    	];
    }

    public function updateRules()
    {
    	return [
            'name' => 'required|min:1|unique:' . $this->table . ',name,' . $this->name . ',name',
    	];
    }

    public function checkIfIdExistsRules()
    {
    	return [
    		'id' => 'required|exists:' . $this->table . ',id',
    	];
    }
}
