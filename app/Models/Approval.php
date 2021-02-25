<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'id' ,'approval_name'
    ];

    public function maingroups()
    {
        return $this->hasMany('App\Models\MainGroup');
    }

    // public function prrequests()
    // {
    //     return $this->hasMany('App\Models\PrRequest');
    // }

    public function stepapprovals()
    {
        return $this->hasMany('App\Models\StepApproval');
    }
}
