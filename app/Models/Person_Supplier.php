<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person_Supplier extends Model
{
    protected $fillable = [
        'id','supplier_id' ,'responsible_person','job_title','mobile','whatsapp','person_email','person_password'
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','person__suppliers');
    }
}
