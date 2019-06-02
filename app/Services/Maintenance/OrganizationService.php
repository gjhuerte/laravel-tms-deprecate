<?php

namespace App\Services\Maintenance;

use App\Models\User\Organization;

class OrganizationService
{
    private $organization;

    /**
     * Creates a an organization
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $this->organization = Organization::create([
            'name' => $attributes['name'],
            'abbreviation' => $attributes['abbreviation'],
            'parent_id' => $attributes['parent_id'] ?? null,
        ]);

        return $this;
    }

    /**
     * Update a an organization
     *
     * @param array $attributes
     * @param integer $organizationId
     * @return mixed
     */
    public function update($attributes, $organizationId)
    {
        $this->organization = Organization::findOrFail((integer) $organizationId);
        $this->organization->update([
            'name' => $attributes['name'],
            'abbreviation' => $attributes['abbreviation'],
            'parent_id' => $attributes['parent_id'] ?? null,
        ]);

        return $this;
    }

    /**
     * Remove an organization
     *
     * @param integer $organizationId
     * @return mixed
     */
    public function remove($organizationId)
    {
        Organization::findOrFail((integer) $organizationId)->delete();
    }
}
