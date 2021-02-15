<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrRequest extends Model
{
    protected $fillable = [
        'date',
        'request_number',
        'department',
        'project',
        'site',
        'main_group_id',
        'user_location',
        'user_id',
    ];

    public function requestitems(){
        return $this->hasMany('App\Models\RequestItem');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function mainGroup()
    {
        return $this->belongsTo('App\Models\MainGroup');
    }
}
