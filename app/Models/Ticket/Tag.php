<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';

    public $fillable = [
        'name'
    ];

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
        'description' => [
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
