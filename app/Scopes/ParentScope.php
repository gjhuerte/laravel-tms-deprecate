<?php

namespace App\Scopes;

trait ParentScope
{

    /**
     * Fetch the parent only
     *
     * @param  $query
     * @return void
     */
    public function scopeRootOnly($query) 
    {
        return $query->whereNull('parent_id');
    }
}
