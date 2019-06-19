<?php

namespace App\Services\Maintenance;

use App\Models\User\User;

class UserService
{
    private $user;

    /**
     * Creates a an user
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $this->user = User::create([
            'firstname' => $attributes['firstname'],
            'middlename' => $attributes['middlename'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'image_url' => $attributes['image_url'],
            'role' => $attributes['role'],
            'organization_id' => $attributes['organization_id'],
            'mobile' => $attributes['mobile'],
            'username' => $attributes['username'],
            'password' => $attributes['password'],
        ]);

        return $this;
    }

    /**
     * Update a an user
     *
     * @param array $attributes
     * @param integer $id
     * @return mixed
     */
    public function update($attributes, $id)
    {
        $this->user = User::findOrFail((integer) $id);
        $this->user->update([
            'firstname' => $attributes['firstname'],
            'middlename' => $attributes['middlename'],
            'lastname' => $attributes['lastname'],
            'email' => $attributes['email'],
            'image_url' => $attributes['image_url'],
            'role' => $attributes['role'],
            'organization_id' => $attributes['organization_id'],
            'mobile' => $attributes['mobile'],
            'username' => $attributes['username'],
            'password' => $attributes['password'],
        ]);

        return $this;
    }

    /**
     * Remove an user
     *
     * @param integer $id
     * @return mixed
     */
    public function remove($id)
    {
        User::findOrFail((integer) $id)->delete();
    }
}
