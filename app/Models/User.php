<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';

    public $columns = [
        'id' => [
            'save' => false,
            'update' => false,
            'select' => true,
        ],
        'firstname' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'username' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'password' => [
            'save' => true,
            'update' => false,
            'select' => false,
            'isHashed' => true,
            'defaultValue' => "123456789",
        ],
        'middlename' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'lastname' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'email' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'mobile' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
        'organization_id' => [
            'save' => true,
            'update' => true,
            'select' => true,
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function loginRules()
    {
        return [
            'username' => "required|exists:users,username",
            'password' => 'required' 
        ];
    }

    public function insertRules()
    {
        return [
            'lastname' => 'required|max:30',
            'username' => 'required|max:30',
            'firstname' => 'required|max:30',
            'middlename' => 'nullable|max:30',
            'mobile' => 'nullable|max:30',
            'email' => 'required|email',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }

    public function updateRules()
    {
        return [
            'lastname' => 'required|max:30',
            'username' => 'required|max:30',
            'firstname' => 'required|max:30',
            'middlename' => 'nullable|max:30',
            'mobile' => 'nullable|max:30',
            'email' => 'required|email',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }

    public function checkIfIdExistsRules()
    {
        return [
            'id' => 'required|exists:' . $this->table . ',id',
        ];
    }

    public function organization()
    {
        return $this->belongsTo( __NAMESPACE__ . '\\Organization', 'organization_id', 'id');
    }

    protected $appends = [
        'full_name', 'organization_name'
    ];

    public function getFullNameAttribute()
    {
        $firstname = $this->firstname;
        $middlename = $this->middlename;
        $lastname = $this->lastname;

        return trim("$lastname, $firstname $middlename");
    }

    public function getOrganizationNameAttribute()
    {
        $organization = isset($this->organization) ? $this->organization->name : 'None';
        return $organization;
    }
}
