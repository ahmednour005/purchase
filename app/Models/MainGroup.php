<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainGroup extends Model
{
    protected $fillable = [
        'id', 'group_name'
    ];


    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function prRequest()
    {
        return $this->hasOne('App\Models\PrRequest');
    }
}
