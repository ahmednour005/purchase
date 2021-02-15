<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'id', 'service_name', 'main_group_id'
    ];
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
    public function suppliers()
    {
        return $this->belongsToMany('App\Models\Supplier');
    }

    public function mainGroup()
    {
        return $this->belongsTo('App\Models\MainGroup','main_group_id','id');
    }

    public function requestItem()
    {
        return $this->hasOne('App\Models\RequestItem');
    }


}
