<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    protected $fillable = [
        'service_id',
        'product_id',
        'item',
        'specification',
        'comment',
        'qtreqtopur',
        'qtonstore',
        'acqtreqtopur',
        'unit',
        'piroirty',
        'currency',
        'budget',
        'rowbudget',
        'request_id'
    ];

    public function prrequest(){
        return $this->belongsTo('App\Models\PrRequest');
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
