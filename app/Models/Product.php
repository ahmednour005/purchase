<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','service_id' ,'prod_name','main_group_id'
    ];
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
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
