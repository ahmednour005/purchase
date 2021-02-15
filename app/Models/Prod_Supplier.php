<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prod_Supplier extends Model
{
    protected $fillable = [
        'id','product_id' ,'supplier_id'
    ];

}
