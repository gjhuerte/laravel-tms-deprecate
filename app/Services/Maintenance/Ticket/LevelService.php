<?php

namespace App\Services\Maintenance\Ticket;

use App\Models\Ticket\Level;

class LevelService
{
    private $level;

    /**
     * Creates a level
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $this->level = Level::create([
            'name' => $attributes['name'],
            'details' => $attributes['details'],
        ]);

        return $this;
    }

    /**
     * Update a level
     *
     * @param array $attributes
     * @param integer $levelId
     * @return mixed
     */
    public function update($attributes, $levelId)
    {
        $this->level = Level::findOrFail((integer) $levelId);
        $this->level->update([
            'name' => $attributes['name'],
            'details' => $attributes['details'],
        ]);

        return $this;
    }

    /**
     * Remove level
     *
     * @param integer $levelId
     * @return mixed
     */
    public function remove($levelId)
    {
        Level::findOrFail($levelId)->delete();
    }
}
