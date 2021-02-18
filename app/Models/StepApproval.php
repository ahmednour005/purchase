<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StepApproval extends Model
{
    protected $fillable = [
        'id','approval_id' ,'step_name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','user__step_approvals');
    }


}
