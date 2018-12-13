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

    public function scopeFilterByParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function parent()
    {
        return $this->belongsTo( __NAMESPACE__ . '\\Category', 'parent_id', 'id');
    }

    protected $appends = [
        'parent_category_name',
    ];

    public function getParentCategoryNameAttribute()
    {
        $parent_name = isset($this->parent) ? $this->parent->name : 'None';
        return $parent_name;
    }
}
