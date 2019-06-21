<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $primaryKey = 'id';

    /**
     * Parse the dates using Carbon package
     * as a date object
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Fillable entries when using eloquent model
     *
     * @var array
     */
    public $fillable = [
        'name',
        'details',
    ];
}
