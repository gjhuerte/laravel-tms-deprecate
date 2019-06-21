<?php

namespace App\Models\OAuth\Access;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'oauth_access_tokens';
}
