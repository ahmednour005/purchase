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
    public function step_approvals()
    {
        return $this->hasMany('App\Models\StepApproval');
    }
}
