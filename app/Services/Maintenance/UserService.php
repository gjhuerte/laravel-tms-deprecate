<?php

namespace App\Services\Maintenance;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

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
        $password = null;
        if (isset($attributes['password'])) {
            $password = Hash::make($attributes['password']);
        }

        $this->user = User::create([
            'firstname' => $attributes['firstname'] ?? null,
            'middlename' => $attributes['middlename'] ?? null,
            'lastname' => $attributes['lastname'] ?? null,
            'email' => $attributes['email'] ?? null,
            'image_url' => $attributes['image_url'] ?? null,
            'role' => $attributes['role'] ?? null,
            'organization_id' => $attributes['organization_id'] ?? null,
            'mobile' => $attributes['mobile'] ?? null,
            'username' => $attributes['username'] ?? null,
            'password' => $password,
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
            'firstname' => $attributes['firstname'] ?? null,
            'middlename' => $attributes['middlename'] ?? null,
            'lastname' => $attributes['lastname'] ?? null,
            'email' => $attributes['email'] ?? null,
            'image_url' => $attributes['image_url'] ?? null,
            'role' => $attributes['role'] ?? null,
            'organization_id' => $attributes['organization_id'] ?? null,
            'mobile' => $attributes['mobile'] ?? null,
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
