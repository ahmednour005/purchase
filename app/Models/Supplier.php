<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'id','service_id' ,'company_mobile','archive','company','phone','address_link','city','country','website',
        'fax','supplier_email','supplier_password','address','accredite','profile_image','service_note','commercial_register_pdf',
        'tax_card_pdf','commercial_register_image','tax_card_image','accredite_note','person_note'
    ];


    public function persons()
    {
        return $this->hasMany('App\Models\Person_Supplier');
    }
    public function services()
    {
        return $this->belongsToMany('App\Models\Service','service__suppliers');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product','prod__suppliers');
    }

}
