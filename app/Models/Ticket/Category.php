<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    /**
     * Columns used when inserting to database using
     * the create function of model
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'parent_id',
    ];

    /**
     * Parse the dates using Carbon package
     * as a date object
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Columns used when querying using eloquent model
     *
     * @var array
     */
    protected $appends = [
        'parent_category_name',
    ];

    /**
     * Fetch the parent name of the current category
     *
     * @return string
     */
    public function getParentCategoryNameAttribute()
    {
        return optional($this->parent)->name;
    }

    /**
     * Link to the parent organization model
     *
     * @return object
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
}
