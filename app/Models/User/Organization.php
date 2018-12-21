<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $primaryKey = 'id';

    /**
     * Columns used when querying using eloquent model
     *
     * @var array
     */
    protected $appends = [
        'parent_organization_name',
    ];

    /**
     * Fetch the parent name of the current organization
     *
     * @return string
     */
    public function getParentOrganizationNameAttribute()
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
        return $this->belongsTo(Organization::class, 'parent_id', 'id');
    }

    /**
     * Filter the organization where the organization has
     * no parent id
     *
     * @param Builder $query
     * @return object
     */
    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
