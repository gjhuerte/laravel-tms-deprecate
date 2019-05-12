<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'id';

    /**
     * Fillable entries when using eloquent
     * 
     * @var array
     */
    public $fillable = [
        'name', 
        'description'
    ];
}
