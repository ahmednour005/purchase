<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_Supplier extends Model
{
    protected $fillable = [
        'id','service_id' ,'supplier_id'
    ];
}
