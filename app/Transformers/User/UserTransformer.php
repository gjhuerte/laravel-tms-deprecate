<?php

namespace App\Transformers\User;

use Carbon\Carbon;
use App\Models\User\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    /**
     * Formats the output of the users
     *
     * @param  User   $user
     * @return mixed
     */
    public function transform(User $user)
    {
        $readableCreatedAt = optional($user->created_at)->format('M d, Y h:m A');
        $readableUpdatedAt = optional($user->updated_at)->format('M d, Y h:m A');

        return [
            'id' => (int) $user->id,
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'image_url' => $user->image_url,
            'full_path_image_url' => asset($user->image_url),
            'role' => $user->role,
            'organization_id' => $user->organization_id,
            'mobile' => $user->mobile,
            'username' => $user->username,
            'is_activated' => $user->is_activated,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'human_readable_created_at' => $readableCreatedAt,
            'human_readable_updated_at' => $readableUpdatedAt,
            'links' => [
                'view_url' => route('user.show', $user->id),
                'edit_url' => route('user.edit', $user->id),
                'remove_url' => route('api.user.destroy', $user->id),
            ],
        ];
    }
}
