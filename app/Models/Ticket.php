<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    public $timestamps = 'true';
    public $fillable = [

    ];

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'details' => 'required|max:1000',
            'category' => 'required|exists:categories,id',
            'level' => 'required|exists:levels,id',
        ];
    }

    public function personnel()
    {
    	return $this->belongsTo( __NAMESPACE__ . '\\User', 'assigned_to', 'id');
    }

    protected $appends = [
    	'assigned_personnel'
    ];

    public function getAssignedPersonnelAttribute()
    {
    	$fullname = isset($this->personnel) ? $this->personnel->full_name : "None";
    	return $fullname;
    }
}
