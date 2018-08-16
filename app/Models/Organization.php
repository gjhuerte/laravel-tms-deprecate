<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
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
        'abbreviation' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'parent_id' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
    ];

    public function insertRules()
    {
    	return [
    		'name' => 'required|min:1|unique:' . $this->table . ',name',
            'abbreviation' => 'required|min:1',
            'parent_id' => 'nullable|exists:' . $this->table . ',id',
    	];
    }

    public function updateRules()
    {
    	return [
            'name' => 'required|min:1|unique:' . $this->table . ',name,' . $this->name . ',name',
            'abbreviation' => 'required|min:1',
            'parent_id' => 'nullable|exists:' . $this->table . ',id',
    	];
    }

    public function checkIfIdExistsRules()
    {
    	return [
    		'id' => 'required|exists:' . $this->table . ',id',
    	];
    }

    public function scopeFilterByParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function parent()
    {
        return $this->belongsTo( __NAMESPACE__ . '\\Organization', 'parent_id', 'id');
    }

    protected $appends = [
        'parent_organization_name',
    ];

    public function getParentOrganizationNameAttribute()
    {
        $parent_name = isset($this->parent) ? $this->parent->name : 'None';
        return $parent_name;
    }
}
