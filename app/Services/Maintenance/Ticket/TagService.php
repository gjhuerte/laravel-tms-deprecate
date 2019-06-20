<?php

namespace App\Services\Maintenance\Ticket;

use App\Models\Ticket\Tag;
use App\Services\BaseService;

class TagService extends BaseService
{

    /**
     * Create a ticket tag or find if exists
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $tag = Tag::firstOrCreate([
            'name' => ucwords($attributes['name']),
            'description' => $attributes['description'],
        ]);

        return $tag;
    }

    /**
     * Update a ticket tag
     *
     * @param array $attributes
     * @param integer $id
     * @return mixed
     */
    public function update($attributes, $id)
    {
        $this->tag = Tag::findOrFail((integer) $id);
        $this->tag->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
        ]);

        return $this;
    }

    /**
     * Remove a ticket tag
     *
     * @param integer $id
     * @return mixed
     */
    public function remove($id)
    {
        Tag::findOrFail((integer) $id)->delete();
    }
}
