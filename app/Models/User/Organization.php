<?php

namespace App\Models\User;

use App\Scopes\ParentScope;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    use ParentScope;

    protected $table = 'organizations';
    protected $primaryKey = 'id';

    /**
     * Fillable columns when using eloquent query
     *
     * @var array
     */
    public $fillable = [
        'name',
        'abbreviation',
        'parent_id'
    ];

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
}
