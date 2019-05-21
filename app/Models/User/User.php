<?php

namespace App\Models\User;

use Illuminate\Support\Str;
use App\Models\User\Organization;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const HEAD_ADMINISTRATOR = 'head administrator';
    const ADMINISTRATOR = 'administrator';
    const DESIGNATOR = 'designator';
    const VERIFIER = 'verifier';
    const SUPPORT = 'support';
    const CLIENT_MANAGER = 'client manager';
    const CLIENT = 'client';
    
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * Columns used when querying using the eloquent model
     *
     * @var array
     */
    protected $appends = [
        'full_name', 
        'organization_name', 
        'first_and_last_name', 
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Fetch the api token used for the app
     * 
     * @return string
     */
    public function getApiTokenAttribute()
    {
        $appName = config('app.name');
        $slugify = Str::slug($appName);

        return $this->createToken($slugify)->accessToken;
    }

    /**
     * Name formatted using firstname then the lastname
     *
     * @return string
     */
    public function getFirstAndLastNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Name formatted using lastname followed by a comma then
     * the firstname and the middlename
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->lastname . ', ' . $this->firstname . ' ' . $this->middlename;
    }

    /**
     * Fetch the organization name
     *
     * @return string
     */
    public function getOrganizationNameAttribute()
    {
        return optional($this->organization)->name;
    }

    /**
     * Link to the users organization model
     *
     * @return object
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}
